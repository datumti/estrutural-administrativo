<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgeExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('badge_exam')) {
            Schema::create('badge_exam', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('construction_id')->unsigned()->nullable();
                $table->foreign('construction_id')->references('id')->on('constructions');
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
        DB::table('badge_exam')->delete();
        Schema::dropIfExists('badge_exam');
    }
}
