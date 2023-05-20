<?php

namespace LaravelCommon\App\Database\Eloquent\Relations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as RelationsBelongsToMany;

class BelongsToMany extends RelationsBelongsToMany
{
    protected Collection $addModelCollection;
    protected Collection $removeModelCollection;
    protected Collection $syncModelColection;

    /**
     * Create a new belongs to many relationship instance.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Database\Eloquent\Model  $parent
     * @param  string  $table
     * @param  string  $foreignPivotKey
     * @param  string  $relatedPivotKey
     * @param  string  $parentKey
     * @param  string  $relatedKey
     * @param  string|null  $relationName
     * @return void
     */
    public function __construct(
        Builder $query,
        Model $parent,
        $table,
        $foreignPivotKey,
        $relatedPivotKey,
        $parentKey,
        $relatedKey,
        $relationName = null
    ) {
        parent::__construct(
            $query,
            $parent,
            $table,
            $foreignPivotKey,
            $relatedPivotKey,
            $parentKey,
            $relatedKey,
            $relationName
        );
        $this->addModelCollection = new Collection();
        $this->removeModelCollection = new Collection();
        $this->syncModelColection = new Collection();
    }

    /**
     *
     * @return Collection
     */
    public function getSyncedCollection(): Collection
    {
        return $this->syncModelColection;
    }

    /**
     * Add model to collection
     * 
     * @param Model $model
     * @return BelongsToMany
     */
    public function add(Model $model): BelongsToMany
    {
        $this->addModelCollection->add($model);
        return $this;
    }

    /**
     * Remove model from collection
     *
     * @param Model $model
     * @return BelongsToMany
     */
    public function remove(Model $model): BelongsToMany
    {
        $inAddedFound = false;
        foreach ($this->addModelCollection as $addModel) {
            if ($addModel->getKey() == $model->getKey()) {
                $inAddedFound;
            }
        }

        if ($inAddedFound) {
            $this->addModelCollection = $this->addModelCollection->filter(
                function ($addModel) use ($model) {
                    return $addModel->getKey() != $model->getKey();
                }
            );
        } else {
            $this->removeModelCollection->add($model);
        }
        return $this;
    }

    /**
     * Set collection of model
     *
     * @param Collection $modelCollection
     * @return BelongsToMany
     */
    public function set(Collection $modelCollection): BelongsToMany
    {
        $this->syncModelColection = $modelCollection;
        return $this;
    }

    /**
     *
     * @return Collection
     */
    public function getCollection(): Collection
    {
        $allCollection = new Collection();
        $existCollection = $this->get();

        foreach ($existCollection as $existModel) {
            $allCollection->add($existModel);
        }

        foreach ($this->addModelCollection as $addModel) {
            $allCollection->add($addModel);
        }

        return $allCollection;
    }

    /**
     * Persist model to database
     *
     * @return void
     */
    public function doAttach()
    {
        foreach ($this->addModelCollection as $addModel) {
            $this->attach($addModel);
        }
    }

    /**
     * Remove model from database
     *
     * @return void
     */
    public function doDetach()
    {
        foreach ($this->removeModelCollection as $removeModel) {
            $this->detach($removeModel);
        }
    }

    /**
     * Sync Model Collection
     *
     * @return void
     */
    public function doSync()
    {
        $this->sync($this->syncModelColection);
    }
}
