<?php

namespace LaravelCommon\App\Entities;

class Scope extends BaseEntity
{
    /**
     * @var string
     */
    private string $name;

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name): Scope
    {
        $this->name = $name;

        return $this;
    }
}