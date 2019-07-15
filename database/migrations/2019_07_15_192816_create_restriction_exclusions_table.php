<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestrictionExclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restriction_exclusions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('restriction_id')->unsigned()->nullable();
            $table->foreign('restriction_id')->references('id')->on('restrictions');
            $table->integer('people_id')->unsigned()->nullable();
            $table->foreign('people_id')->references('id')->on('people');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restriction_exclusions');
    }
}
