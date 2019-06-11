<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([ 'name' => 'Master', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'Gerente de Contrato', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'Matriz', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'Administrativo de Obras', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'Qualidade', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'S.M.S', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'Supervisor', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'RH', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'Direção', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('profiles')->insert([ 'name' => 'Aux. Administrativo', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
    }
}
