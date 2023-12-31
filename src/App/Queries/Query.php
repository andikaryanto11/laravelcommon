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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Query extends Builder
{
    protected $model;
    protected string $table;
    protected ?LengthAwarePaginator $lengthAwarePaginator = null;

    // NOTE: we used to do have issue on grammar on laravel 9.xx
    // when use DB::connection()->query()->getGrammar() the grammar is always incorrect while querying the database
    // this is constructor that fix the issue on laravel 9.xx
    // public function __construct(
    //     Model $model,
    //     ConnectionInterface $connection,
    //     Grammar $grammar = null,
    //     Processor $processor = null
    // ) {
    //     $grammar = $connection->query()->getGrammar();
    //     parent::__construct($connection, $grammar, $processor);

    //     $this->model = $model;
    //     $this->table = $model->getTable();
    //     $this->fromSelect();
    // }

    /**
     * Create a new query builder instance.
     *
     * @return void
     */
    public function __construct(
        ConnectionInterface $connection = null,
        Grammar $grammar = null,
        Processor $processor = null
    ) {
        $connection = DB::connection();
        $grammar = $connection->query()->getGrammar();
        parent::__construct($connection, $grammar);

        $identity = $this->identityClass();
        $this->model = new $identity();
        $this->table = $this->model->getTable();
        $this->fromSelect();
    }

    protected function getSelectColumns()
    {
        $columns = Schema::getColumnListing($this->model->getTable());
        $columnsWithAlias = [];
        foreach ($columns as $column) {
            $columnsWithAlias[] = $this->table . '.' . $column; // . ' as ' .  $this->table . '_' . $column;
        }

        return $columnsWithAlias;
    }

    /**
     * Undocumented function
     *
     * @param array $columns
     * @return Collection
     */
    public function getIterator($columns = ['*'])
    {
        $this->onModelContext();
        $models = null;
        if (!is_null($this->lengthAwarePaginator)) {
            $models = $this->lengthAwarePaginator->items();
        } else {
            $models = $this->get($columns)->all();
        }

        $identityClass = get_class($this->model);
        return $identityClass::hydrate($models);
    }

    public function joinWith($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
    {
        if (!empty($this->joins)) {
            foreach ($this->joins as $join) {
                if ($join->table == $table) {
                    return $this;
                }
            }
        }

        // echo 'jasasdsaoin';
        return  $this->join($table, $first, $operator, $second, $type, $where);
    }

    public function fromSelect()
    {
        return $this->from($this->table, $this->table)->select($this->getSelectColumns());
    }

    public function onModelContext()
    {
        if (!empty($this->joins)) {
            $newBuilder = new static($this->connection, $this->grammar, $this->getProcessor());
            $this->limit = null;
            $this->offset = null;
            $ids = $this->distinct()->pluck($this->table . '.' . $this->model->getKeyName());

            $newBuilder->fromSelect()
                ->whereIdIn($ids->toArray());
            if ($this->getPage() &&  $this->getPerPage()) {
                $newBuilder->paging(
                    $this->getPerPage(),
                    $this->getPage()
                );
            }

            $newBuilder->orders = $this->orders;

            $this->lengthAwarePaginator = $newBuilder->lengthAwarePaginator;
        }

        return $this;
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
        $this->joins = [];
        $this->columns = [];
        $this->from = null;
        $this->lengthAwarePaginator = null;
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
    public function identityClass()
    {
        // return get_class($this->model);
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
