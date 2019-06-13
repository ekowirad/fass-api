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
            $table->integer('sex')->default(0);
            $table->integer('religion')->default(0);
            $table->integer('education')->default(0);
            $table->integer('marital_status')->default(0);
            $table->char('speak_english', 7)->default(null);
            $table->char('dog_fear', 7)->default(null);
            $table->string('age')->default(null);
            $table->longText('skills')->default(null);
            $table->longText('price_month')->default(null);
            $table->bigInteger('job_id')->unsigned()->index();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->integer('ethnic_id')->unsigned();
            $table->foreign('ethnic_id')->references('id')->on('ethnics');
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
