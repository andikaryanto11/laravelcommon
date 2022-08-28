<?php

namespace LaravelCommon\App\ViewModels\User;

use LaravelCommon\App\Entities\User\Token;
use LaravelCommon\ViewModels\AbstractViewModel;
use stdClass;

class TokenViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Token $entity
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource(array &$element)
    {
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'token' => $this->entity->getToken(),
            'expired_at' => $this->entity->getExpiredAt()->format('Y-m-d H:i:s')
        ];
    }
}
