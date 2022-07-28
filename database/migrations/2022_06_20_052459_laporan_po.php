<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanPo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_po', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->foreignId('pr_id');
            $table->foreign('pr_id')->references('id')->on('purchase_request');
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
        Schema::dropIfExists('laporan_po');
    }
}
