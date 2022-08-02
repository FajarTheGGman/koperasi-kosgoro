<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvoiceProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_products', function(Blueprint $table){
            $table->id();
            $table->string('nomor_invoice');
            $table->string('name');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('type');
            $table->string('image');
            $table->string('barcode');
            $table->integer('sell_price');
            $table->integer('total_income');
            $table->foreignId('rack_id');
            $table->foreignId('user_id');
            $table->foreignId('invoice_id');
            $table->foreign('rack_id')->references('id')->on('rack');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('invoice_id')->references('id')->on('invoice');
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
        Schema::dropIfExists('invoice_products');
    }
}
