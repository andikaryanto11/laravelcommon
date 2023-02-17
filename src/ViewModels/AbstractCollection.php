<?php

namespace LaravelCommon\ViewModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use LaravelOrm\Entities\EntityList;

abstract class AbstractCollection
{
    protected $collection;

    /**
     * @var ?Request
     */
    protected $request;

    protected array $element = [];

    /**
     * @param array|EntityList $collection
     */
    public function __construct($collection, ?Request $request = null)
    {
        $this->collection = $collection;
        $this->request = $request;
    }

    /**
     * Eloquent to View Model
     */
    abstract public function shape(Model $model);

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
        $items = $viewModel->finalArray();
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
