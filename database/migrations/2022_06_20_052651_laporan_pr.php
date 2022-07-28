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
            $table->foreignId('rack_id');
            $table->foreign('rack_id')->references('id')->on('rack');
            $table->string('supplyer');
            $table->string('total_price');
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
