<?php

namespace LaravelCommon\Responses;

class NotAllowedResponse extends BaseResponse
{
    public function __construct(string $message, $responseCode = [], $data = null)
    {
        parent::__construct($message, 405, $responseCode, $data);
    }
}
