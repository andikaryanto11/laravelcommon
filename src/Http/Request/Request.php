<?php

namespace LaravelCommon\Http\Request;

use App\Repositories\User\TokenRepository;
use Illuminate\Http\Request as HttpRequest;

class Request extends HttpRequest {

    /**
     * @var TokenRepository $tokenRepository
     */
    protected TokenRepository $tokenRepository;

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

    public function getToken(){
        if($this->hasHeader('Authorization')){
            $authorization = $this->header('Authorization');
            $param = [
                'where' => ['token', '=', $authorization]
            ];
            return $this->tokenRepository->findOne($param);
        }
        return null;
    }

}