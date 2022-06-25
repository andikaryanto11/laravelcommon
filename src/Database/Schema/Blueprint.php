<?php

namespace LaravelCommon\Database\Schema;

use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Database\Schema\Blueprint as SchemaBlueprint;

class Blueprint extends SchemaBlueprint
{

    /**
     * add auditable created_by and modified_by
     * 
     * @return ColumnDefinition
     */
    public function auditable(): ColumnDefinition
    {
        $this->string('created_by');
        return $this->string('modified_by');
    }
}
