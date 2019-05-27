<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            //order columns
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('handphone');
            $table->string('address');
            $table->bigInteger('labor_id')->unsigned()->nullable();
            $table->foreign('labor_id')->references('id')->on('labors');
            $table->char('order_type', 3);
            $table->string('day_start');
            $table->string('day_end');
            $table->string('hour_day');
            $table->string('hour_start');

            // sales columns
            $table->bigInteger('id_revenue')->unsigned();
            $table->foreign('id_revenue')->references('id')->on('revenues');
            $table->bigInteger('admin_cost')->default(0);
            $table->bigInteger('salary_cut')->default(0);
            $table->bigInteger('total_cost')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
