<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('permission_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_permission')->unsigned()->nullable();
            $table->foreign('id_permission')->references('id')->on('permission');
            $table->integer('id_profile')->unsigned()->nullable();
            $table->foreign('id_profile')->references('id')->on('profiles');
            $table->string('limit');
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
        DB::table('permission_profile')->delete();
        Schema::dropIfExists('permission_profile');
    }
}
