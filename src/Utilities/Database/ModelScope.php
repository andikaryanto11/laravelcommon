<?php

namespace LaravelCommon\Utilities\Database;

use Exception;
use Illuminate\Database\Eloquent\Model;

class ModelScope
{
    public const PERFORM_ADD_UPDATE = '1addUpdate';
    public const PERFORM_DELETE = '2delete';

    /**
     *
     * @var ModelScope|null
     */
    private static ?ModelScope $instance = null;

    /**
     *
     * @var array
     */
    private array $entities = [];

    private function __construct()
    {
    }

    /**
     *
     * @return ModelScope
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Add model that will be persisted
     *
     * @param string $perfom
     * @param IModel $model
     * @param bool $needValidate - validate model that will be persisted
     * @return void
     */
    public function addModel(string $perfom, Model $model, $needValidate = true)
    {
        $isModelExist = false;
        if (isset($this->entities)) {
            foreach ($this->entities as $existedModel) {
                if ($model === $existedModel['model'] && $perfom === $model['perform']) {
                    $isModelExist = true;
                    break;
                }
            }
        }

        if (!$isModelExist) {
            $this->entities[] = [
                'perform' => $perfom,
                'model' => $model,
                'needValidate' => $needValidate
            ];
        }
    }

    /**
     * Sort the entities
     *
     * @return ModelScope
     */
    public function sort()
    {
        ksort($this->entities);
        return $this;
    }

    /**
     * Get entities scope
     *
     * @return array
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * Clean model scope
     *
     * @return void
     */
    public function clean()
    {
        $this->entities = [];
    }
}
