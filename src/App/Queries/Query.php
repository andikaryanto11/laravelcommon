<?php

namespace LaravelCommon\App\Queries;

use Exception;
use LaravelOrm\Entities\EntityList;
use LaravelOrm\Queries\Query as QueriesQuery;

abstract class Query extends QueriesQuery
{

    // /**
    //  *
    //  * @inheritdoc
    //  */
    // public function identity()
    // {
    //     throw new Exception('"identity" function needs to be override');
    // }

    /**
     * @return string
     */
    public abstract function collectionClass();


    /**
     * Undocumented function
     *
     * @return PaggedCollection
     */
    public function getPagedCollection()
    {
        $page = null;
        $size = null;
        $this->filterDefaultRequestParameter();
        $totalRecord = $this->count();

        $this->limitDefaultReuqestParameter($page, $size);

        $collection = $this->getIterator();

        $collectionClass = $this->collectionClass();
        $collection = new $collectionClass($collection);
        $collection->setPage($page);
        $collection->setSize($size);
        $collection->setTotalRecord($totalRecord);
        return $collection;
    }

    private function limitDefaultReuqestParameter(&$page, &$size){
        $colelctionPagingConfig = app('config')->get('common-config');
        $size = $colelctionPagingConfig['collection_paging']['size'];

        $this->limit($size);

        if (isset(request()->size)) {
            $size = request()->size;
            $this->limit($size);
        }
        if (isset(request()->page)) {
            $page = request()->page;
            $this->offset(request()->page - 1 * $size);
        }
    }

    private function filterDefaultRequestParameter()
    {

        

        if (isset(request()->order_by)) {
            $column = request()->order_by;
            $this->orderBy($column);
        }

        if (isset(request()->order_by) && isset(request()->order_direction)) {
            $column = request()->order_by;
            $direction = strtoupper(request()->order_direction) == 'DESC' ? 'DESC' : 'ASC';
            $this->orderBy($column, $direction);
        }


        if (isset(request()->search_by) && isset(request()->search_value)) {

            $column = request()->search_by;
            $value = request()->search_value;
            $this->where($column, 'like', '%' . $value . '%');
        }
    }
}
