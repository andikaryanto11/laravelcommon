<?php

use Illuminate\Database\Migrations\Migration;
use LaravelCommon\System\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserScopeMappings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_scope_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->auditable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_scope_mappings');
    }
}