<?php

namespace LaravelCommon\Responses;

class ForbiddenResponse extends BaseResponse
{
    public function __construct(string $message, $responseCode = [], $data = null)
    {
        parent::__construct($message, 403, $responseCode, $data);
    }
}
