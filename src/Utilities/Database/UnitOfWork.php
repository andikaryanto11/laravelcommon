<?php

namespace LaravelCommon\Utilities\Database;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LaravelCommon\App\Database\Eloquent\Relations\BelongsToManyRelation;
use LaravelCommon\Exceptions\ValidationException;
use ReflectionClass;
use ReflectionProperty;

/**
 * singleton instance that is created using provider see: CommonAppServiceProvider
 * we need to this singleton to share between classes while this class is injected
 * it is responsible to do data transaction in entire application.
 */
class UnitOfWork
{
    private bool $isTransactionStarted = false;

    /**
     * Prepare entity that will be validated and persisted.
     * Will persisted after entity unit flush
     *
     * @see entity Model->validate()
     *
     * @param Model $model
     * @param bool $needValidate - validate entity that will be persisted
     * @throws ValidationException
     * @return UnitOfWork
     */
    public function persist(Model $model)
    {
        // $modelScope = ModelScope::getInstance();
        if (!$this->isTransactionStarted) {
            DB::beginTransaction();
            $this->isTransactionStarted = true;
        }

        $model->save();

        $reflectionClass = new ReflectionClass($model);
        $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            if (
                $property->getType() &&
                $property->getType()->getName() == BelongsToManyRelation::class
            ) {
                $value = $property->getValue($model);
                $value->setParentModel($model);

                if ($value->getSyncedCollection()->count() > 0) {
                    $value->doSync();
                } else {
                    $value->doAttach();
                    $value->doDetach();
                }
            }
        }

        return $this;
    }

    /**
     * Prepare entity that will be removed. Will removed after entity unit flush
     *
     * @param Model $model
     * @return UnitOfWork
     */
    public function remove(Model $model)
    {
        // $modelScope = ModelScope::getInstance();
        if (!$this->isTransactionStarted) {
            DB::beginTransaction();
            $this->isTransactionStarted = true;
        }

        if (method_exists($model, 'trashed')) {
            $model->trashed();
        } else {
            $model->forceDelete();
        }

        // $modelScope->addModel(ModelScope::PERFORM_DELETE, $model);
        return $this;
    }

    /**
     * Persist all entities to table
     *
     * @return void
     */
    public function flush()
    {
        try {
            if ($this->isTransactionStarted) {
                DB::commit();
            }
        } catch (Exception $e) {
            if ($this->isTransactionStarted) {
                DB::rollBack();
            }
            throw $e;
        }
    }
}
