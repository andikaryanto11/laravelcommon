<?php

namespace LaravelCommon\App\Repositories;

use Exception;
use LaravelCommon\App\Services\CollectionQueryParameters;
use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;
use LaravelOrm\Repository\Repository;

class BaseRepository extends Repository implements RepositoryInterface
{

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected array $filters = [];

    /**
     * Get view collection and paged the collection
     *
     * @param array $filter
     * @return PaggedCollection
     */
    public function gather($filter = [])
    {

        $colelctionPagingConfig = app('config')->get('common-config');

        $filter['limit'] = [
            'page' => 1,
            'size' => $colelctionPagingConfig['collection_paging']['size']
        ];

        $filter = CollectionQueryParameters::getCollectionParameters($filter);

        $countParams = $filter;
        unset($countParams['limit']);
        $totalRecord = $this->count($countParams);

        $collection = $this->collect($filter);
        $collectionClass = $this->collectionClass();
        $collection = new $collectionClass($collection);
        $collection->setPage($filter['limit']['page']);
        $collection->setSize($filter['limit']['size']);
        $collection->setTotalRecord($totalRecord);
        return $collection;
    }

    /**
     * Set filters
     *
     * @param array $filters
     * @return self
     */
    public function addFilters(array $filters = []): self
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @inheritDoc
     */
    public function collectionClass(): string
    {
        throw new Exception('"collectionClass" needs to be overrided in your repository classes');
    }

    /**
     * @inheritDoc
     */
    public function viewModelClass(): string
    {
        throw new Exception('"viewModelClass" needs to be overrided in your repository classes');
    }

    /**
     * @inheritDoc
     */
    public function validateEntity(IEntity $entity): void
    {
    }
}
