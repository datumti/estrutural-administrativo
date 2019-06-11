<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('fsas')) {
            Schema::create('fsas', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('person_id')->unsigned()->nullable();
                $table->foreign('person_id')->references('id')->on('people');
                $table->char('schooling')->nullable();
                $table->char('experience')->nullable();
                $table->char('skills')->nullable();
                $table->text('competence_obs')->nullable();
                $table->char('direct_leadership')->nullable();
                $table->char('supervisor')->nullable();

                $table->char('quality_opinion')->nullable();
                $table->char('quality_obs')->nullable();

                $table->char('admin_opinion')->nullable();
                $table->char('admin_salary')->nullable();
                $table->char('admin_obs')->nullable();

                $table->char('manager_opinion')->nullable();
                $table->char('manager_obs')->nullable();

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
        DB::table('fsas')->delete();
        Schema::dropIfExists('fsas');
    }
}
