<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRestricionsAddCpfNome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restrictions', function (Blueprint $table) {
            //
            $table->string('name')->after('people_id')->nullable();
            $table->string('cpf')->after('people_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restrictions', function (Blueprint $table) {
            //
            $table->dropColumn('name');
            $table->dropColumn('cpf');
        });
    }
}
