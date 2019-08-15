<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('managers')) {
            Schema::create('managers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('construction_id')->unsigned()->nullable();
                $table->foreign('construction_id')->references('id')->on('constructions');
                $table->integer('contract_id');
                $table->integer('person_id_sms')->unsigned()->nullable();
                $table->foreign('person_id_sms')->references('id')->on('people');
                $table->integer('person_id_quality')->unsigned()->nullable();
                $table->foreign('person_id_quality')->references('id')->on('people');
                $table->integer('person_id_production')->unsigned()->nullable();
                $table->foreign('person_id_production')->references('id')->on('people');
                $table->integer('person_id_discipline')->unsigned()->nullable();
                $table->foreign('person_id_discipline')->references('id')->on('people');

                $table->integer('manager_id_sms')->unsigned()->nullable();
                $table->foreign('manager_id_sms')->references('id')->on('people');
                $table->integer('manager_id_quality')->unsigned()->nullable();
                $table->foreign('manager_id_quality')->references('id')->on('people');
                $table->integer('manager_id_production')->unsigned()->nullable();
                $table->foreign('manager_id_production')->references('id')->on('people');
                $table->integer('manager_id_discipline')->unsigned()->nullable();
                $table->foreign('manager_id_discipline')->references('id')->on('people');

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
        DB::table('managers')->delete();
        Schema::dropIfExists('managers');
    }
}
