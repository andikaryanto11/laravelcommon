<?php

namespace LaravelCommon\App\Entities;

class LoggingConfig extends BaseEntity
{
    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var boolean
     */
    protected bool $isEnabled = false;


    /**
     * Get the value of name
     *
     * @return  string|null
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string|null  $name
     *
     * @return  self
     */
    public function setName($name): LoggingConfig
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of isEnabled
     *
     * @return  boolean
     */
    public function getIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * Set the value of isEnabled
     *
     * @param  boolean  $isEnabled
     *
     * @return  self
     */
    public function setIsEnabled(bool $isEnabled): LoggingConfig
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }
}
