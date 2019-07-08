<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JobsTableSeeder::class);
        $this->call(ConstructionsTableSeeder::class);
        $this->call(ExamsTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(TrainingsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ProcessesTableSeeder::class);
        //$this->call(ContractConstructionTableSeeder::class);
        $this->call(TimesheetsTableSeeder::class);
        $this->call(JobTrainingsTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionProfileTableSeeder::class);
    }
}
