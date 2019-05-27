<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToLaborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labors', function (Blueprint $table) {
            $table->string('mother_name')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_job')->nullable();
            $table->string('fam_name')->nullable();
            $table->string('fam_handphone')->nullable();
            $table->string('ref_name')->nullable();
            $table->string('ref_handphone')->nullable();
            $table->integer('weight')->default(0);
            $table->integer('height')->default(0);
            $table->integer('skin')->default(0);
            $table->integer('hair')->default(0);
            $table->string("price_month");
            $table->string("price_day");
            $table->string("price_hour");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labors', function (Blueprint $table) {
            //
        });
    }
}
