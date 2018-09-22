<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
    public function up()
    {
        Schema::create('shop', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        }); 
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->unsignedInteger('shop_id');
            $table->foreign('shop_id')
                ->references('id')
                ->on('shop')
                ->onDelete('cascade');
        });   
        //Name it Orders instead of order cause
        // order is a reservate word in pgsql
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total', 8, 2)
                ->nullable();
            $table->unsignedInteger('shop_id');
            $table->foreign('shop_id')
                ->references('id')
                ->on('shop')
                ->onDelete('cascade');
        });
        Schema::create('line_item', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total', 8, 2);
            $table->decimal('price', 8, 2);
            $table->decimal('quantity', 8, 0)
                ->nullable();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('orders_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('product');
            $table->foreign('orders_id')
                ->references('id')
                ->on('orders');
        });         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('line_item', function(Blueprint $table){
            $table->dropForeign(['product_id']);
            $table->dropForeign(['orders_id']);
        });

        Schema::table('product', function(Blueprint $table){
            $table->dropForeign(['shop_id']);
        });
        Schema::table('orders', function(Blueprint $table){
            $table->dropForeign(['shop_id']);
        });

        Schema::dropIfExists('line_item');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('product');
        Schema::dropIfExists('shop');
    }
}
