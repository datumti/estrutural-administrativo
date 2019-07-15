<?php

use Illuminate\Database\Seeder;

class ConstructionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Models\Construction::class, 2)->create();

        DB::table('constructions')->insert([ 'name' => 'REFAP', 'status' => 1, 'cut_grade' => 9, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
        DB::table('constructions')->insert([ 'name' => 'POLO PETROQUÍMICO', 'status' => 1, 'cut_grade' => 8, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);
    }
}
