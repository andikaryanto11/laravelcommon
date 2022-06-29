<?php

namespace LaravelCommon\System\Database\Schema;

use Illuminate\Database\Schema\Blueprint as SchemaBlueprint;
use Illuminate\Database\Schema\ColumnDefinition;

class Blueprint extends SchemaBlueprint
{

    /**
     * created_by and updated_by column
     *
     * @return ColumnDefinition
     */
    public function auditable(): ColumnDefinition
    {
        $this->string('created_by')->nullable();
        return $this->string('updated_by')->nullable();
    }
}
