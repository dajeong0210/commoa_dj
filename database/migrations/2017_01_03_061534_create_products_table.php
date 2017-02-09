<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->string('url');
            $table->integer('price')->unsigned();
            $table->tinyInteger('os')->unsigned();
            $table->integer('ram')->unsigned();
            $table->integer('ssd')->unsigned()->nullable();
            $table->integer('hdd')->unsigned()->nullable();
            $table->tinyInteger('overclock')->unsigned();
            $table->integer('power')->unsigned();
            $table->integer('monitor')->unsigned()->nullable();
            $table->integer('views')->unsinged()->default(0);
            $table->integer('recommend')->unsinged()->default(0);
            $table->string('use');
            $table->timestamps();

            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->integer('cpu_id')->unsigned();
            $table->foreign('cpu_id')->references('id')->on('cpus');
            $table->integer('vga_id')->unsigned();
            $table->foreign('vga_id')->references('id')->on('vgas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
