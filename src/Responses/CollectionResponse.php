<?php

namespace LaravelCommon\Responses;

use LaravelCommon\App\Repositories\BaseRepository;
use LaravelCommon\ViewModels\AbstractCollection;
use LaravelCommon\ViewModels\PaggedCollection;

class CollectionResponse extends BaseResponse
{
    public function __construct(string $message, $responseCode = [], $data = null, $additionalData = [])
    {
        $newData = [];
        if ($data instanceof AbstractCollection) {
             $newData = $data->proceed()->getElements();
        }

        $json = ['_resources' => $newData];
        $mergeJson = array_merge($json, $additionalData); 

        parent::__construct($message, 200, $responseCode, $mergeJson);
    }
}