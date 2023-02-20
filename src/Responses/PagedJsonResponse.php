<?php

namespace LaravelCommon\Responses;

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
    protected LengthAwarePaginator $paginator;

    public function __construct(string $message, $responseCode = [], Query $query = null)
    {

        $this->query = $query;
        $newData = $this->getPagedCollection();
        $json = [];
        if (!is_null($newData)) {
            $json = [
                '_paging' => [
                    'page' =>  $this->paginator->currentPage(),
                    'limit' => $this->paginator->perPage(),
                    'total_data' => $this->paginator->total()
                ]
            ];

            $json['_links'] = [
                'next_page' => $this->paginator->nextPageUrl(),
                'prev_page' => $this->paginator->previousPageUrl(),
                'current_page' => $this->paginator->url($this->paginator->currentPage())
            ];
        }

        parent::__construct($message, 200, $responseCode, $newData, $json);
    }

    /**
     * getPagedCollection
     *
     * @return PagedCollection
     */
    private function getPagedCollection()
    {
        $this->paginator = $this->filterAndSortFromRequest();
        $collectionClass = $this->query->collectionClass();
        $identityClass = $this->query->identityClass();

        $models = $identityClass::hydrate($this->paginator->items());

        $collection = new $collectionClass($models);
        $collection->setPage($this->paginator->currentPage());
        $collection->setSize($this->paginator->total());
        $collection->setTotalRecord($this->paginator->total());
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

        return $this->query->paginate($size, ['*'], 'page', $page);
    }
}
