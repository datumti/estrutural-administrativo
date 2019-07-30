<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('trainings')) {
            Schema::create('trainings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->integer('expiration');
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
        DB::table('trainings')->delete();
        Schema::dropIfExists('trainings');
    }
}
