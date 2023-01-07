<?php

namespace LaravelCommon\ViewModels;

use LaravelOrm\Entities\EntityList;
use LaravelOrm\Interfaces\IEntity;

abstract class AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    protected $entity;

    protected $resource;
    /**
     * @param IEntity $entity
     */
    public function __construct(IEntity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Convert instance to array add auto add resource available
     */
    public function finalArray()
    {
        $this->resource = $this->toArray();
        if ($this->getIsAutoAddResource()) {
            $this->addResource();
        }
        return $this->resource;
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @param AbstractViewModel|AbstractCollection $value
     * @return void
     */
    public function embedResource(
        string $key,
        AbstractViewModel|AbstractCollection $value
    ) {
        if ($value instanceof AbstractViewModel) {
            $this->resource[$key] = $value->finalArray();
        }

        if ($value instanceof AbstractCollection) {
            $this->resource[$key] = $value->finalProcceed();
        }
    }

    /**
     * Convert instance to array
     */
    abstract public function toArray();

    /**
     * Add resource to view model
     */
    abstract public function addResource();

    /**
     *  set auto add Resource
     */
    public function setIsAutoAddResource(bool $isAutoAddResource): self
    {
        $this->isAutoAddResource = $isAutoAddResource;
        return $this;
    }

    /**
     * if set true then view model will auto add available resource you define
     * @return bool
     */
    public function getIsAutoAddResource(): bool
    {
        return $this->isAutoAddResource;
    }

    /**
     * Get entity instance
     *
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
