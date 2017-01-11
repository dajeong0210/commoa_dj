<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('shop_name');
            $table->string('shop_url');
            $table->string('business_name');
            $table->string('business_ceo');
            $table->string('business_address');
            $table->string('business_no');
            $table->string('business_sale_no');
            $table->string('business_docu');
            $table->string('sale_docu');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_mobile');
            $table->string('contact_phone')->nullable();
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
        Schema::dropIfExists('applies');
    }
}
