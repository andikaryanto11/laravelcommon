<?php

namespace LaravelCommon\App\Consts;

use ReflectionClass;

class BaseConts
{
    public $reflection = null;

    public function __construct()
    {
        $this->reflection = new ReflectionClass(static::class);
    }

    /**
     * Get all contstants value of the class as object
     */
    public static function getConstants()
    {
        $self = new static();
        return $self->reflection->getConstants();
    }
}
