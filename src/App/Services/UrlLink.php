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
        $data['current'] = url()->current() . '&page=' . $paggedCollection->getPage();

        $data['previuos'] = empty($paggedCollection->getPreviousPage())
            ? null
            : url()->current() . '&page=' . $paggedCollection->getPreviousPage();

        $data['next'] = empty($paggedCollection->getNextPage())
            ? null
            : url()->current() . '&page=' . $paggedCollection->getNextPage();

        return $data;
    }
}
