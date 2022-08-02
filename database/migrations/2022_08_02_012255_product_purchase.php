<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_purchase', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('type');
            $table->string('image');
            $table->string('barcode');
            $table->string('sell_price');
            $table->integer('total_income');
            $table->foreignId('rack_id');
            $table->foreignId('pr_id');
            $table->foreign('rack_id')->references('id')->on('rack');
            $table->foreign('pr_id')->references('id')->on('laporan_pr');
            $table->date('expired_date');
            $table->string('status')->default('Process');
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
        Schema::dropIfExists('products_purchase');
    }
}
