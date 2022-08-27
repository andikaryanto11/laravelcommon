<?php

namespace LaravelCommon\App\Utilities;

use Exception;
use Illuminate\Database\QueryException;
use LaravelCommon\Exceptions\DbQueryException;
use LaravelOrm\Entities\EntityUnit as EntitiesEntityUnit;

class EntityUnit extends EntitiesEntityUnit
{
    public function flush()
    {
        try {
            parent::flush();
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                if ($e->getCode() == 23000) {
                    throw new DbQueryException('Data with uniq value exist');
                }
            }
            throw $e;
        }
    }
}
