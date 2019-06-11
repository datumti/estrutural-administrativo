<?php

use Illuminate\Database\Seeder;

class TimesheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Timesheet::class, 30)->create();
    }
}
