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
        Schema::create('orders', function (Blueprint $table){
            //order columns
            $table->bigIncrements('id');
            $table->string('note_id')->nullable()->default(null);
            $table->string('name');
            $table->bigInteger('handphone');
            $table->string('address');
            $table->char('time_type', 3);
            $table->string('day_start')->nullable()->default(null);
            $table->string('day_end')->nullable()->default(null);
            // time type hour, choose date to order labor
            $table->string('hour_date')->nullable()->default(null);
            $table->string('hour_start')->nullable()->default(null);
            $table->string('hour_end')->nullable()->default(null);
            $table->integer('status');
            $table->bigInteger('labor_id')->unsigned()->nullable();
            $table->foreign('labor_id')->references('id')->on('labors');
            // labor requirement if theres no labor available
            $table->bigInteger('order_labor_id')->unsigned();
            $table->foreign('order_labor_id')->references('id')->on('order_labors');

            // sales columns
            $table->bigInteger('revenue_id')->unsigned();
            $table->foreign('revenue_id')->references('id')->on('revenues');
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
