<?php

namespace LaravelCommon\App\Queries;

use Exception;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Processors\Processor;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Builder;

class Query extends Builder
{
    protected $model;

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
        $models = $this->get($columns)->all();

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

    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     *
     *
     * @return string
     */
    public function identityClass()
    {
        return get_class($this->model);
    }

    public function collectionClass()
    {
        throw new Exception('"Query::collectionClass needs to be overridden"');
    }
}
