<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('groups')) {
            Schema::create('groups', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('construction_id')->unsigned()->nullable();
                $table->foreign('construction_id')->references('id')->on('constructions');
                $table->integer('process_id')->unsigned()->nullable();
                $table->foreign('process_id')->references('id')->on('processes');

                $table->integer('training_id')->unsigned()->nullable();
                $table->foreign('training_id')->references('id')->on('trainings');

                $table->date('creation_date')->nullable();

                $table->string('clinic_name')->nullable();
                $table->string('clinic_code')->nullable();
                $table->string('crm')->nullable();

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
        DB::table('groups')->delete();
        Schema::dropIfExists('groups');
    }
}
