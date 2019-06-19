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
           $table->string('note_id')->nullable()->default(null);
           $table->integer('status'); // order status
           $table->string('name');
           $table->bigInteger('handphone');
           $table->string('address');
           $table->char('time_type', 3);

           // daily order type columns
           $table->string('day_start')->nullable()->default(null);
           $table->string('day_end')->nullable()->default(null);
           $table->bigInteger('day_cost')->default(0);

           // hour order type columns
           // time type hour, choose date to order labor
           $table->string('hour_date')->nullable()->default(null);
           $table->string('hour_start')->nullable()->default(null);
           $table->string('hour_end')->nullable()->default(null);
           $table->bigInteger('hour_cost')->default(0);

           $table->bigInteger('labor_id')->unsigned()->nullable();
           $table->foreign('labor_id')->references('id')->on('labors');
           // labor requirement if theres no labor available

           // sales columns
           $table->bigInteger('revenue_id')->unsigned()->nullable();
           $table->foreign('revenue_id')->references('id')->on('revenues');
           $table->bigInteger('admin_cost')->default(0)->nullable();
           $table->bigInteger('salary_cut')->default(0)->nullable();
           $table->bigInteger('total_cost')->default(0)->nullable();
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
