<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('products', function(Blueprint $table){
                $table->bigIncrements('id');
                $table->string('name');
                $table->integer('quantity');
                $table->integer('price');
                $table->string('type');
                $table->string('image');
                $table->string('barcode');
                $table->integer('sell_price');
                $table->string('total_income');
                $table->foreignId('rack_id');
                $table->foreign('rack_id')->references('id')->on('rack');
                $table->date('expired_date');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
