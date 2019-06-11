<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vacancy_training')) {
            Schema::create('vacancy_training', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('vacancy_id')->unsigned()->nullable();
                $table->foreign('vacancy_id')->references('id')->on('vacancies');
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
        DB::table('vacancy_training')->delete();
        Schema::dropIfExists('vacancy_training');
    }
}
