<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('resignations')) {
            Schema::create('resignations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('person_id')->unsigned()->nullable();
                $table->foreign('person_id')->references('id')->on('people');

                $table->integer('construction_id')->unsigned()->nullable();
                $table->foreign('construction_id')->references('id')->on('constructions');

                $table->text('description')->nullable();

                $table->integer('evaluation_quality')->nullable();
                $table->integer('evaluation_sms')->nullable();
                $table->integer('evaluation_discipline')->nullable();
                $table->integer('evaluation_production')->nullable();

                $table->integer('fired')->nullable();

                $table->integer('transfered')->nullable();

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
        DB::table('resignations')->delete();
        Schema::dropIfExists('resignations');
    }
}
