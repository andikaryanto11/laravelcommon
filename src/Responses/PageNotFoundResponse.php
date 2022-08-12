<?php

namespace LaravelCommon\Responses;

class PageNotFoundResponse extends BaseResponse
{
    public function __construct(string $message, $responseCode = [], $data = null)
    {
        parent::__construct($message, 404, $responseCode, $data);
    }
}
