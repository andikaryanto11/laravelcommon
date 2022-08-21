<?php

namespace LaravelCommon\App\Services;

use LaravelCommon\ViewModels\PaggedCollection;

class UrlLink
{

    /**
     * Create links
     *
     * @param PaggedCollection $paggedCollection
     * @return array
     */
    public static function createLinks(PaggedCollection $paggedCollection): array
    {
        $data = [];

        $queryParams = CollectionQueryParameters::getQueryParameters(['page']);

        $queryParam = !empty($queryParams) 
            ? "&" . http_build_query($queryParams)
            : '';

        $data['current'] = url()->current() . '?page=' . $paggedCollection->getPage() . $queryParam;

        $data['previous'] = empty($paggedCollection->getPreviousPage())
            ? null
            : url()->current() . '&page=' . $paggedCollection->getPreviousPage() . $queryParam;

        $data['next'] = empty($paggedCollection->getNextPage())
            ? null
            : url()->current() . '&page=' . $paggedCollection->getNextPage(). $queryParam;

        $data['first'] = url()->current() . '?page=1' . $queryParam;
        $data['last'] = url()->current() . '?page=' . $paggedCollection->getTotalPage() . $queryParam;

        return $data;
    }
}
