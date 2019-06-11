<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('processes')->insert([ 'name' => 'Seleção Técnica', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('processes')->insert([ 'name' => 'Seleção Psicológica', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('processes')->insert([ 'name' => 'Seleção Treinamento', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('processes')->insert([ 'name' => 'Seleção Exame', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('processes')->insert([ 'name' => 'Seleção Crachá', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
    }
}
