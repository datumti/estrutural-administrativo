<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('people')) {
            Schema::create('people', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('password')->nullable();
                $table->integer('profile_id')->nullable();
                $table->integer('construction_id')->unsigned()->nullable();
                $table->foreign('construction_id')->references('id')->on('constructions');
                $table->string('cpf')->nullable();
                $table->integer('job_id')->unsigned()->nullable();
                $table->foreign('job_id')->references('id')->on('jobs');
                $table->string('ctps')->nullable();
                $table->string('rg')->nullable();
                $table->string('phoneMobile')->nullable();
                $table->string('mobileAlternative')->nullable();
                $table->dateTime('birthDate')->nullable();
                $table->char('pcd')->nullable();
                $table->string('motherName')->nullable();
                $table->string('address')->nullable();
                $table->string('addressNumber')->nullable();
                $table->string('addressExtra')->nullable();
                $table->string('neighborhood')->nullable();
                $table->string('city')->nullable();
                $table->string('states')->nullable();
                $table->string('cep')->nullable();
                $table->string('bootNumber')->nullable();
                $table->string('pantsNumber')->nullable();
                $table->string('shirtNumber')->nullable();
                $table->string('markNumber')->nullable();
                $table->string('number')->nullable();
                $table->rememberToken();
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
        DB::table('people')->delete();
        Schema::dropIfExists('people');
    }
}
