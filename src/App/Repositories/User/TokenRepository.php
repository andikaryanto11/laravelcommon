<?php

namespace LaravelCommon\App\Repositories\User;

use LaravelCommon\App\Entities\User\Token;
use LaravelCommon\App\Repositories\BaseRepository;
use LaravelCommon\App\ViewModels\User\TokenCollection;
use LaravelCommon\App\ViewModels\User\TokenViewModel;

class TokenRepository extends BaseRepository implements
    TokenRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Token::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return TokenCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return TokenViewModel::class;
    }
}
