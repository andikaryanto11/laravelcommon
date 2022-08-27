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
        $json = [];

        if($this->data instanceof PaggedCollection){
            $json['paging']['next_page'] = $this->data->getNextPage();
            $json['paging']['prev_page'] = $this->data->getPreviousPage();
            $json['paging']['total_page'] = $this->data->getTotalPage();
            $json['paging']['page'] = $this->data->getPage();
            $json['paging']['size'] = $this->data->getSize();
            $json['paging']['total_record'] = $this->data->getTotalRecord();

            $links = UrlLink::createLinks($this->data);

            $json['links'] = $links;
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

    /**
     * Get response message
     *
     * @return void
     */
    public function getMessage(){
        return $this->message;
    }
}
