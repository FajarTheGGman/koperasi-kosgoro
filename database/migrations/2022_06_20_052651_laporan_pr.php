<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanPr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pr', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('quantity');
            $table->string('price');
            $table->string('type');
            $table->string('image');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplyer');
            $table->string('sell_price');
            $table->string('rak');
            $table->string('status');
            $table->string('description');
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
        Schema::dropIfExists('laporan_pr');
    }
}
