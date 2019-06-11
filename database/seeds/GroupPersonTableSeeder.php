<?php

use Illuminate\Database\Seeder;

class GroupPersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\GroupPerson::class, 100)->create();
    }
}
