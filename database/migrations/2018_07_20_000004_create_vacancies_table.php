<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vacancies')) {
            Schema::create('vacancies', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('construction_id')->unsigned()->nullable();
                $table->foreign('construction_id')->references('id')->on('constructions');
                $table->integer('number');
                $table->integer('contract_id');
                $table->boolean('quality_vacancy');
                $table->integer('job_id')->unsigned()->nullable();
                $table->foreign('job_id')->references('id')->on('jobs');
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
        DB::table('vacancies')->delete();
        Schema::dropIfExists('vacancies');
    }
}
