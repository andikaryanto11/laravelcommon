<?php

namespace LaravelCommon\Responses;

class ServerErrorResponse extends BaseResponse
{
    public function __construct(string $message, $responseCode = [], $data = null)
    {
        parent::__construct($message, 500, $responseCode, $data);
    }
}
