<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgeTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('badge_training')) {
            Schema::create('badge_training', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('construction_id')->unsigned()->nullable();
                $table->foreign('construction_id')->references('id')->on('constructions');
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
        DB::table('badge_training')->delete();
        Schema::dropIfExists('badge_training');
    }
}
