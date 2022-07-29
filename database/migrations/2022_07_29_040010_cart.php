<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('type');
            $table->string('image');
            $table->string('barcode')->nullable();
            $table->integer('sell_price');
            $table->foreignId('rack_id');
            $table->foreignId('user_id');
            $table->foreign('rack_id')->references('id')->on('rack');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->string('status')->default('Process');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cart');
    }
}
