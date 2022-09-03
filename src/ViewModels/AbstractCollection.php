<?php

namespace LaravelCommon\ViewModels;

use LaravelOrm\Entities\EntityList;
use LaravelOrm\Interfaces\IEntity;

abstract class AbstractCollection
{
    protected $collection;
    protected array $element = [];

    /**
     * @param array|EntityList $collection
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Eloquent to View Model
     */
    abstract public function shape(IEntity $entity);

    /**
     * proceed shaping to view model
     */
    public function proceed()
    {
        foreach ($this->collection as $item) {
            $this->shape($item);
        }
        return $this;
    }

    public function finalProcceed()
    {
        return $this->proceed()->getElements();
    }

    /**
     * Add item element
     *
     */
    public function addItem(AbstractViewModel $viewModel): void
    {
        $items = $viewModel->toArray();
        $viewModel->addResource($items, $this->collection);
        $this->element[] = $items;
    }

    /**
     * Get elemet
     */
    public function getElements(): array
    {
        return $this->element;
    }

    /**
     * Get count of element
     *
     * @return int
     */
    public function count()
    {
        return $this->collection->count();
    }

    /**
     * Get Entity List
     *
     * @return EntityList
     */
    public function getEntityList()
    {
        return $this->collection;
    }
}
