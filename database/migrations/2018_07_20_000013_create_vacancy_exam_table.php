<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vacancy_exam')) {
            Schema::create('vacancy_exam', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('vacancy_id')->unsigned()->nullable();
                $table->foreign('vacancy_id')->references('id')->on('vacancies');
                $table->integer('exam_id')->unsigned()->nullable();
                $table->foreign('exam_id')->references('id')->on('exams');
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
        DB::table('vacancy_exam')->delete();
        Schema::dropIfExists('vacancy_exam');
    }
}
