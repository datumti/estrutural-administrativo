<?php

use Illuminate\Database\Seeder;

class ContractConstructionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ContractConstruction::class, 2)->create();
    }
}
