<?php

namespace LaravelCommon\App\Queries;

use Exception;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Processors\Processor;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class Query extends Builder
{
    protected $model;
    protected ?LengthAwarePaginator $lengthAwarePaginator = null;

    /**
     * Create a new query builder instance.
     *
     * @param  \Illuminate\Database\ConnectionInterface  $connection
     * @param  \Illuminate\Database\Query\Grammars\Grammar|null  $grammar
     * @param  \Illuminate\Database\Query\Processors\Processor|null  $processor
     * @return void
     */
    public function __construct(
        Model $model,
        ConnectionInterface $connection,
        Grammar $grammar = null,
        Processor $processor = null
    ) {
        $this->model = $model;
        $grammar = $connection->query()->getGrammar();
        parent::__construct($connection, $grammar, $processor);
        $table = $model->getTable();
        $this->from($table)->select('*');
    }

    /**
     * Undocumented function
     *
     * @param array $columns
     * @return Collection
     */
    public function getIterator($columns = ['*'])
    {
        $models = null;
        if (!is_null($this->lengthAwarePaginator)) {
            $models = $this->lengthAwarePaginator->items();
        } else {
            $models = $this->get($columns)->all();
        }

        $identityClass = get_class($this->model);
        return $identityClass::hydrate($models);
    }

    /**
     * Reset Query
     *
     * @return $this
     */
    public function reset()
    {
        $this->groups = [];
        $this->wheres = [];
        return $this;
    }

    /**
     * paginate
     *
     * @param integer $perPage
     * @param integer|null $page
     * @param array $columns
     * @param string $pageName
     * @return Query
     */
    public function paging(
        int $perPage = 15, 
        ?int $page = null, 
        array $columns = ['*'], 
        string $pageName = 'page'
    ): Query {
        $this->lengthAwarePaginator = $this->paginate($perPage, $columns, $pageName, $page);
        return $this;
    }

    /**
     *
     * @return LengthAwarePaginator|null
     */
    public function getAwarePaginator(): ?LengthAwarePaginator
    {
        return $this->lengthAwarePaginator;
    }

    /**
     * get table name
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->model->getTable();
    }

    /**
     * get current page
     *
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->lengthAwarePaginator?->currentPage();
    }

    /** Get total data 
     *
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->lengthAwarePaginator?->total();
    }

    /** Get total data 
     *
     * @return int|null
     */
    public function getPerPage(): ?int
    {
        return $this->lengthAwarePaginator?->perPage();
    }

    /**
     *
     *
     * @return string
     */
    public function identityClass(): string
    {
        return get_class($this->model);
    }



    /**
     * get view model collection class
     *
     * @return string
     */
    public function collectionClass()
    {
        throw new Exception('"Query::collectionClass needs to be overridden"');
    }

    /**
     *
     * @param array $ids
     * @return $this
     */
    public function whereIdIn(array $ids)
    {
        $this->whereIn('id', $ids);
        return $this;
    }
}
