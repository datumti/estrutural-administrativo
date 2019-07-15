<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('restrictions')) {
            Schema::create('restrictions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('people_id')->unsigned()->nullable();
                //$table->foreign('people_id')->references('id')->on('people');
                $table->text('description');
                $table->timestamps();
                $table->softDeletes();
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
        DB::table('restrictions')->delete();
        Schema::dropIfExists('restrictions');
    }
}
