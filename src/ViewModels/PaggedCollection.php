<?php

namespace LaravelCommon\ViewModels;

use LaravelOrm\Entities\EntityList;
use LaravelOrm\Interfaces\IEntity;

abstract class PaggedCollection extends AbstractCollection
{

    protected ?int $page = null;
    protected ?int $size = null;
    protected ?int $totalRecord = null;

    /**
     * Get the value of page
     * @return ?int
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @return  self
     */
    public function setPage(int $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of size
     * 
     * @return ?int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of totalRecord
     * 
     * @return ?int
     */
    public function getTotalRecord(): ?int
    {
        return $this->totalRecord;
    }

    /**
     * Set the value of totalRecord
     *
     * @return  self
     */
    public function setTotalRecord(?int $totalRecord)
    {
        $this->totalRecord = $totalRecord;

        return $this;
    }

    /**
     * 
     *
     * @return int
     */
    public function getTotalPage(): int
    {
        if ($this->totalRecord > $this->size) {
            return ceil($this->totalRecord / $this->size);
        } else {
            return 1;
        }
    }

    /**
     * Get next page
     *
     * @return ?int
     */
    public function getNextPage(): ?int
    {
        if ($this->getTotalPage() > 1) {
            if ($this->page < $this->getTotalPage()) {
                return $this->page + 1;
            }
        }
        return null;
    }

    /**
     * Get Prev page
     *
     * @return ?int
     */
    public function getPreviousPage(): ?int
    {
        if ($this->getTotalPage() > 1) {
            if ($this->page < $this->getTotalPage()) {
                return $this->page > 1 ? $this->page - 1 : null;
            }
        }
        return null;
    }
}
