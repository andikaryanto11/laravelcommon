<?php

namespace LaravelCommon\Responses;

use App\System\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use LaravelCommon\App\Queries\Query;
use LaravelCommon\Responses\CollectionResponse;

class PagedJsonResponse extends CollectionResponse
{
    /**
     * @var Query
     */
    protected ?Query $query = null;
    protected ?Request $request = null;

    public function __construct(string $message, $responseCode = [], Query $query = null, ?Request $request = null)
    {

        $this->query = $query;
        $this->request = $request;

        parent::__construct($message, 200, $responseCode);
    }
    
    /**
     *
     * @return Query|null
     */
    public function getQuery(): ?Query
    {
        return $this->query;
    }

    /**
     * getPagedCollection
     *
     * @return PagedCollection
     */
    public function getPagedCollection()
    {
        $this->filterAndSortFromRequest();
        $collectionClass = $this->query->collectionClass();

        $models = $this->query->getIterator();

        $collection = new $collectionClass($models, $this->request);
        $collection->setPage($this->query->getPage());
        $collection->setSize($this->query->getTotal());
        $collection->setTotalRecord($this->query->getTotal());
        return $collection;
    }

    /**
     * Undocumented function
     *
     * @return LengthAwarePaginator
     */
    private function filterAndSortFromRequest()
    {
        $request = request();
        $table = $this->query->getTable();
        $sortDirection = 'ASC';
        $sortColumn = null;
        $size = config("common-config")['collection_paging']['size'];
        $page = 1;


        if (isset($request->order_direction)) {
            $sortDirection = strtolower($request->order_direction);
        }

        if (isset($request->order_by)) {
            $sortColumn = $request->order_by;
        }

        if (!is_null($sortColumn)) {
            $this->query->orderBy($table . '.' . $sortColumn, $sortDirection);
        }

        if (isset($request->size)) {
            $size = $request->size;
        }

        if (isset($request->page)) {
            $page = $request->page;
        }

        if (isset($request->keyword)) {
            $keyword = $request->keyword;
            $searchColumns = Schema::getColumnListing($this->query->getTable());
            foreach ($searchColumns as $column) {
                $this->query->orWhere($table . '.' . $column, 'like', '%' . $keyword . '%');
            }
        } else {
            if (isset($request->search_by) && isset($request->search_value)) {
                $searchBy = $request->search_by;
                $searchValue = $request->search_value;
                $this->query->where($searchBy, 'like', '%' . $searchValue . '%');
            }

            if (isset($request->search_value)) {
            }
        }

        return $this->query->paging($size, $page);
    }
}
