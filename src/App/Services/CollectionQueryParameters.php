<?php

namespace LaravelCommon\App\Services;

class CollectionQueryParameters
{

    /**
     * Create query parameters as collection filters
     *
     * @param array $filter
     * @return array
     */
    public static function getCollectionParameters($filter = []): array
    {
        if (isset(request()->page)) {
            $filter['limit']['page'] = request()->page;
        }

        if (isset(request()->size)) {
            $filter['limit']['size'] = request()->size;
        }

        if (isset(request()->order_by)) {
            $column = request()->order_by;
            $filter['order'][$column] = 'ASC';
        }

        if (isset(request()->order_by) && isset(request()->order_direction)) {
            $column = request()->order_by;
            $filter['order'][$column] = strtoupper(request()->order_direction) == 'DESC' ? 'DESC' : 'ASC';
        }


        if (isset(request()->search_by) && isset(request()->search_value)) {
            $column = request()->search_by;
            $value = request()->search_value;
            $filter['where'][] = [$column, 'like', '%' . $value . '%'];
        }

        return $filter;
    }

    /**
     * get query params as array
     *
     * @return array
     */
    public static function getQueryParameters($except = []): array
    {
        $parameters = [];

        if (isset(request()->page) && !in_array('page', $except)) {
            $parameters['page'] = request()->page;
        }

        if (isset(request()->size) && !in_array('size', $except)) {
            $parameters['size'] = request()->size;
        }

        if (isset(request()->order_by) && !in_array('order_by', $except)) {
            $parameters['order_by'] = request()->order_by;
        }

        if (isset(request()->order_direction) && !in_array('order_by', $except)) {
            $parameters['order_direction'] = request()->order_direction;
        }


        if (isset(request()->search_by) && 
            isset(request()->search_value) && 
            !in_array('search_by', $except) && 
            !in_array('search_value', $except)
        ) {
            $parameters['search_by'] = request()->search_by;
            $parameters['search_value'] = request()->search_value;
        }

        return $parameters;
    }
}
