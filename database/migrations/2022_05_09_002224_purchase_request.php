<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchaseRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request', function(Blueprint $table){
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
        Schema::dropIfExists('purchase_request');
    }
}
