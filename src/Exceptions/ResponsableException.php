<?php

namespace LaravelCommon\Exceptions;

use Exception;
use LaravelCommon\Responses\BaseResponse;

class ResponsableException extends Exception
{
    /**
     * Undocumented variable
     *
     * @var
     */
    protected $response;

    /**
     * Undocumented function
     *
     * @param string $message
     * @param mixed $response
     */
    public function __construct(string $message, $response)
    {
        parent::__construct($message);
        $this->response = $response;
    }

    /**
     * Get Response
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
