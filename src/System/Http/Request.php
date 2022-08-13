<?php

namespace LaravelCommon\System\Http;

use LaravelCommon\App\Repositories\User\TokenRepository;
use Illuminate\Http\Request as HttpRequest;

class Request extends HttpRequest {

    /**
     * @var TokenRepository $tokenRepository
     */
    protected TokenRepository $tokenRepository;

    protected $resource;

    /**
     * Undocumented function
     *
     * @param TokenRepository $tokenRepository
     */
    public function __construct(
        TokenRepository $tokenRepository
    )
    {
        $this->tokenRepository = $tokenRepository;
        parent::__construct();
    }

    /**
     * Undocumented function
     *
     * @return 
     */
    public function getToken(){
        $accpet = $this->query; 
        $gt = $_GET; 
        if($this->hasHeader('Authorization')){
            $authorization = $this->header('Authorization');
            $param = [
                'where' => ['token', '=', $authorization]
            ];
            return $this->tokenRepository->findOne($param);
        }
        return null;
    }

    /**
     * Undocumented function
     *
     * @param mixed $entity
     * @return Request
     */
    public function setResource($entity){
        $this->resource = $entity;
        $json = $this->json();
        $this->resource->hydrate($json);
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function getResource(){
        return $this->resource;

    }

}