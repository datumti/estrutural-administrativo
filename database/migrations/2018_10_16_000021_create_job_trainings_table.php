<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_trainings')) {
            Schema::create('job_trainings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('job_id')->unsigned()->nullable();
                $table->foreign('job_id')->references('id')->on('jobs');
                $table->integer('training_id')->unsigned()->nullable();
                $table->foreign('training_id')->references('id')->on('trainings');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('job_trainings')->delete();
        Schema::dropIfExists('job_trainings');
    }
}
