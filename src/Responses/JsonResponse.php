<?php

namespace LaravelCommon\Responses;

use LaravelCommon\ViewModels\AbstractViewModel;
use LaravelCommon\ViewModels\PaggedCollection;

class JsonResponse extends BaseResponse
{
    public function __construct(string $message, int $code = 200, $responseCode = [], $data = null)
    {

        $newData = $this->buildData($data);

        parent::__construct($message, $code, $responseCode, $newData);
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    private function buildData($data = null)
    {
        if (is_null($data)) {
            return null;
        }

        $newData = null;
        if ($data instanceof AbstractViewModel) {
            $newData = $data->finalArray();
        }

        return $newData;
    }
}
