<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_child', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->foreignId('menu_parent_id');
            $table->foreign('menu_parent_id')->references('id')->on('menu_parent');
            $table->string('name');
            $table->string('route');
            $table->string('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_child');
    }
}
