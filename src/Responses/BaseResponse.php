<?php

namespace LaravelCommon\Responses;

use LaravelCommon\App\Services\UrlLink;
use LaravelCommon\ViewModels\AbstractCollection;
use LaravelCommon\ViewModels\AbstractViewModel;
use LaravelCommon\ViewModels\PaggedCollection;
use Symfony\Component\HttpFoundation\Response;

class BaseResponse extends Response implements ResponseInterface
{
    /**
     * @var string
     */
    protected string $message;

    /**
     * @var
     */
    protected $data;

    /**
     * @var integer
     */
    protected int $code;

    /**
     * @var array
     */
    protected array $reponseCode;

    public function __construct(string $message, int $code, $reponseCode, $data = null)
    {
         $this->message     = $message;
         $this->data        = $data;
         $this->code        = $code;
         $this->reponseCode = $reponseCode;
         parent::__construct(json_encode($data), $code);
    }

    /**
     * Get data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function send()
    {

        $json['message'] = $this->message;
        $json['data'] = $this->data;
        $json['response'] = $this->reponseCode;

        return response()->json($json, $this->code);
    }

    /**
     * Get response message
     *
     * @return void
     */
    public function getMessage()
    {
        return $this->message;
    }
}
