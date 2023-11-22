<?php

namespace LaravelCommon\App\ViewModels\User;

use Doctrine\Common\Lexer\Token;
use Illuminate\Database\Eloquent\Model;
use LaravelCommon\ViewModels\PaggedCollection;

class TokenCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(Model $model): ?TokenViewModel
    {
        if ($model instanceof Token) {
            return new TokenViewModel($model, $this->request);
        }
    }
}
