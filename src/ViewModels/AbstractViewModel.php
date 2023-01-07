<?php

namespace LaravelCommon\ViewModels;

use Illuminate\Http\Request;
use LaravelCommon\Responses\BaseResponse;
use LaravelOrm\Entities\EntityList;
use LaravelOrm\Interfaces\IEntity;

abstract class AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    protected $entity;

    /**
     * @var ?Request
     */
    protected $request;

    /**
     *
     * @var array
     */
    protected $resource;

    /**
     * @param IEntity $entity
     */
    public function __construct(IEntity $entity, ?Request $request = null)
    {
        $this->entity = $entity;
        $this->request = $request;
    }

    /**
     * Convert instance to array add auto add resource available
     */
    public function finalArray()
    {
        if (method_exists($this->entity, 'getId')) {
            $this->resource['id'] = $this->entity->getId();
        }

        $this->resource = array_merge($this->resource, $this->toArray());

        if (method_exists($this->entity, 'getCreatedAt')) {
            $this->resource['created_at'] =  !is_null($this->entity->getCreatedAt())
            ? $this->entity->getCreatedAt()->format('Y-m-d H:i:s')
            : null;
        }

        if (method_exists($this->entity, 'getUpdatedAt')) {
            $this->resource['updated_at'] = !is_null($this->entity->getUpdatedAt())
                ? $this->entity->getUpdatedAt()->format('Y-m-d H:i:s')
                : null;
        }

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

        if ($this->request != null && $this->request->getPathInfo() == '/graphql') {
        } else {
            if ($value instanceof AbstractViewModel) {
                $this->resource[BaseResponse::RESOURCES_KEY] = [$key => $value->finalArray()];
            }

            if ($value instanceof AbstractCollection) {
                $this->resource[BaseResponse::RESOURCES_KEY] = [$key => $value->finalProcceed()];
            }
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
