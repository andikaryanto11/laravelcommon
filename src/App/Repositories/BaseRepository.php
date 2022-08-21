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
