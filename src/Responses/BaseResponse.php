<?php

namespace LaravelCommon\Responses;

use LaravelCommon\ViewModels\AbstractCollection;
use LaravelCommon\ViewModels\AbstractViewModel;
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
         parent::__construct();
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
        $json = [];

        if($this->data instanceof AbstractCollection){
            $json['page'] = $this->data->getPage();
            $json['size'] = $this->data->getSize();
            $json['total_record'] = $this->data->getTotalRecord();
        }

        $json['message'] = $this->message;
        $json['data'] = $this->proceededData();
        $json['response'] = $this->reponseCode;

        return response()->json($json, $this->code);
    }

    private function proceededData()
    {
        if ($this->data instanceof AbstractCollection) {
            return $this->data->proceed()->getElements();
        }

        if ($this->data instanceof AbstractViewModel) {
            $array = $this->data->finalArray();
            return $array;
        }

        return $this->data;
    }
}
