<?php

namespace LaravelCommon\Responses;

class BadRequestResponse extends BaseResponse
{
    public function __construct(string $message, $responseCode, $data)
    {
        parent::__construct($message, 400, $responseCode, $data);
    }
}
