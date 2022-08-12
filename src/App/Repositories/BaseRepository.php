<?php

namespace LaravelCommon\App\Repositories;

use Exception;
use LaravelOrm\Repository\Repository;

class BaseRepository extends Repository implements RepositoryInterface {

    /**
     * Get view collection
     *
     * @param array $filter
     * @param array $columns
     * @return mixed
     */
    public function collectViewModel($filter = [], $columns = []){
        $colection = $this->collect($filter, $columns);
        $collectionClass = $this->collectionClass();
        return new $collectionClass($colection);
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
}