<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('register_id');
            $table->bigInteger('ktp_id')->default(0);
            $table->string('birth_place');
            $table->string('birth_date');
            $table->integer('sex')->default(0);
            $table->integer('age')->default(0);
            $table->integer('ethnic_id')->unsigned();
            $table->foreign('ethnic_id')->references('id')->on('ethnics');
            $table->integer('education')->default(0);
            $table->integer('religion')->default(0);
            $table->integer('marital_status')->default(0);
            $table->bigInteger('handphone')->default(0);
            $table->char('district_id', 7);
            $table->foreign('district_id')->references('id')->on('districts');
            $table->char('regency_id', 4);
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->char('province_id', 2);
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->string('address');

            $table->longText('skills')->nullable();
            $table->bigInteger('job_id')->unsigned()->index();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->char('speak_english', 7);
            $table->char('dog_fear', 7);
            $table->integer('status');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE labors AUTO_INCREMENT = 1001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labors');
    }
}
