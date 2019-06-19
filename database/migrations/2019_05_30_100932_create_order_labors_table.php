<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLaborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_labors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sex')->default(0)->nullable();
            $table->integer('religion')->default(0)->nullable();
            $table->integer('education')->default(0)->nullable();
            $table->integer('marital_status')->default(0)->nullable();
            $table->char('speak_english', 7)->default(null)->nullable();
            $table->char('dog_fear', 7)->default(null)->nullable();
            $table->string('age')->default(null)->nullable();
            $table->longText('skills')->default(null)->nullable();
            $table->string('ethnic')->default(null)->nullable();
            $table->string('job')->default(null)->nullable();
            $table->char('time_type', 3)->default(0)->nullable();
            $table->longText('range_price')->default(null)->nullable();
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_labors');
    }
}
