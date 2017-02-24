<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->tinyInteger('sort')->unsigned()->nullable();
            $table->string('color')->nullable();
            $table->string('min_cpu')->nullable();
            $table->string('min_vga')->nullable();
            $table->integer('min_memory')->unsigned()->nullable();
            $table->integer('storage')->unsigned()->nullable();
            $table->string('recommend_cpu')->nullable();
            $table->string('recommend_vga')->nullable();
            $table->integer('recommend_memory')->unsigned()->nullable();
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
        Schema::dropIfExists('categories');
    }
}
