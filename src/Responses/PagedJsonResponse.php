<?php

namespace LaravelCommon\Responses;

use LaravelCommon\App\Queries\Query;
use LaravelCommon\App\Repositories\Repository;
use LaravelCommon\App\Services\UrlLink;
use LaravelCommon\ViewModels\PaggedCollection;

class PagedJsonResponse extends CollectionResponse
{
    public function __construct(string $message, $responseCode = [], $data = null)
    {

        $newData = $this->buildData($data);
        $json = [];
        if (!is_null($newData)) {
            $json = [
                '_paging' => [
                    'next_page' => $newData->getNextPage(),
                    'prev_page' => $newData->getPreviousPage(),
                    'total_page' => $newData->getTotalPage(),
                    'page' => $newData->getPage(),
                    'size' => $newData->getSize(),
                    'total_record' => $newData->getTotalRecord()
                ]
            ];

            $links = UrlLink::createLinks($newData);

            $json['_links'] = $links;
        }

        parent::__construct($message, 200, $responseCode, $newData, $json);
    }

    /**
     * Undocumented function
     *
     * @return PaggedCollection
     */
    private function buildData($data = null)
    {

        if (is_null($data)) {
            return null;
        }

        $newData = null;
        if ($data instanceof Repository) {
            $filters = $data->getFilters();
            $newData = $data->gather($filters);
        }

        if ($data instanceof Query) {
            $newData = $data->getPagedCollection();
        }

        return $newData;
    }
}
