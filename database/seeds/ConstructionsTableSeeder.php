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
        factory(App\Models\Construction::class, 2)->create();
    }
}
