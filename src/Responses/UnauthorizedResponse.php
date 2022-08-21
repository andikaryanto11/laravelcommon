<?php

namespace LaravelCommon\Responses;

class UnauthorizedResponse extends BaseResponse
{
    public function __construct(string $message, $responseCode = [], $data = null)
    {
        parent::__construct($message, 401, $responseCode, $data);
    }
}
