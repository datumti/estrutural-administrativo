<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('constructions')) {
            Schema::create('constructions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('status');
                $table->string('cut_grade');
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
        DB::table('constructions')->delete();
        Schema::dropIfExists('constructions');
    }
}
