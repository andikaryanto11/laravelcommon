<?php

namespace LaravelCommon\System\Http;

use LaravelCommon\App\Repositories\User\TokenRepository;
use Illuminate\Http\Request as HttpRequest;
use LaravelCommon\App\Entities\User\Token;

class Request extends HttpRequest
{

    /**
     * @var TokenRepository $tokenRepository
     */
    protected TokenRepository $tokenRepository;

    /**
     * Undocumented function
     *
     * @param [type] $userToken
     * @return void
     */
    public function setuserToken(Token $userToken)
    {
        $this->userToken = $userToken;
    }

    /**
     * Undocumented function
     *
     * @return 
     */
    public function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * Undocumented function
     *
     * @param mixed $entity
     * @return Request
     */
    public function setResource($entity)
    {
        $this->resource = $entity;
        return $this;
    }

    /**
     * hydrate resource
     *
     * @param mixed $entity
     * @return void
     */
    public function hyrdateResource($entity)
    {
        $this->setResource($entity);
        $json = $this->input();
        $this->resource->hydrate($json);
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }
}
