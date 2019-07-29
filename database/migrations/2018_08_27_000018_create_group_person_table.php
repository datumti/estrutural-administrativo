<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('group_person')) {
            Schema::create('group_person', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('group_id')->unsigned()->nullable();
                $table->foreign('group_id')->references('id')->on('groups');
                $table->integer('person_id')->unsigned()->nullable();
                $table->foreign('person_id')->references('id')->on('people');
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id')->references('id')->on('statuses');
                $table->integer('status_aso_id')->unsigned()->nullable();
                $table->foreign('status_aso_id')->references('id')->on('statuses');
                $table->decimal('note', 8, 1)->nullable();
                $table->text('description')->nullable();
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
        DB::table('group_person')->delete();
        Schema::dropIfExists('group_person');
    }
}
