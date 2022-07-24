<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AclPrevileges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_previleges', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->foreignId('role_id');
            $table->foreignId('menu_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('menu_id')->references('id')->on('menu_child');
            $table->boolean('access')->default(1);
            $table->boolean('write')->default(1);
            $table->boolean('read')->default(1);
            $table->boolean('update')->default(1);
            $table->boolean('delete')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acl_previleges');
    }
}
