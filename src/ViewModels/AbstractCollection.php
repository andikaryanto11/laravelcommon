<?php

namespace LaravelCommon\ViewModels;

use LaravelOrm\Entities\EntityList;
use LaravelOrm\Interfaces\IEntity;

abstract class AbstractCollection
{
    protected $collection;
    protected array $element = [];
    protected ?int $page = null;
    protected ?int $size = null;
    protected ?int $totalRecord = null;

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
     * Get the value of page
     * @return ?int
     */ 
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @return  self
     */ 
    public function setPage(int $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of size
     * 
     * @return ?int
     */ 
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */ 
    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of totalRecord
     * 
     * @return ?int
     */ 
    public function getTotalRecord(): ?int
    {
        return $this->totalRecord;
    }

    /**
     * Set the value of totalRecord
     *
     * @return  self
     */ 
    public function setTotalRecord(?int $totalRecord)
    {
        $this->totalRecord = $totalRecord;

        return $this;
    }
}
