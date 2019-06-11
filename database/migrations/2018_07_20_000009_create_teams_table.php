<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('teams')) {
            Schema::create('teams', function (Blueprint $table) {
                $table->increments('id');
                $table->string('openings');
                $table->integer('construction_id')->unsigned()->nullable();
                $table->foreign('construction_id')->references('id')->on('constructions');
                $table->integer('contract_id');
                $table->integer('person_id')->unsigned()->nullable();
                $table->foreign('person_id')->references('id')->on('people');
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
        DB::table('teams')->delete();
        Schema::dropIfExists('teams');
    }
}
