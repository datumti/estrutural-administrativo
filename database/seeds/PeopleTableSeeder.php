<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Person::class, 50)->create();
        DB::table('people')->insert(['name' => 'Master', 'email' => 'admin', 'password' => bcrypt('123'), 'profile_id' => '1', 'construction_id' => '1', 'cpf' => '251.793.553-39', 'job_id' => '2', 'ctps' => '6325069686-5', 'rg' => '6524091712', 'phoneMobile' => '1-855-373-9940', 'mobileAlternative' => '866-266-7611', 'birthDate' => '1996/02/05 00:00:01', 'pcd' => '0', 'motherName' => 'Admin', 'address' => 'Missouri Curve', 'addressNumber' => '74049', 'addressExtra' => 'Apt.201', 'neighborhood' => 'Maria Tunnel', 'city' => 'lake Shanna', 'states' => 'RS', 'cep' => '80679395', 'bootNumber' => '39', 'pantsNumber' => '93', 'shirtNumber' => '59', 'markNumber' => '59', 'number' => '56909', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'Gerente','email' => 'gerente', 'password' => '123', 'profile_id' => '2', 'construction_id' => '1', 'cpf' => '263.240.980-28', 'job_id' => '7', 'ctps' => '0563191295-0', 'rg' => '111513182', 'phoneMobile' => '0-555-373-9940', 'mobileAlternative' => '966-266-7612', 'birthDate' => '1995/05/10 02:00:01', 'pcd' => '0', 'motherName' => 'Admin', 'address' => 'Missouri Curve', 'addressNumber' => '74049', 'addressExtra' => 'Apt.201', 'neighborhood' => 'Maria Tunnel', 'city' => 'lake Shanna', 'states' => 'RS', 'cep' => '80679395', 'bootNumber' => '39', 'pantsNumber' => '93', 'shirtNumber' => '59', 'markNumber' => '59', 'number' => '56909', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'Diretor','email' => 'diretor', 'password' => '123', 'profile_id' => '9', 'construction_id' => '1', 'cpf' => '965.493.930-43', 'job_id' => '3', 'ctps' => '', 'rg' => '143476178', 'phoneMobile' => '', 'mobileAlternative' => '', 'birthDate' => '1997/12/12 05:05:02', 'pcd' => '1', 'motherName' => '', 'address' => '', 'addressNumber' => '', 'addressExtra' => '', 'neighborhood' => '', 'city' => '', 'states' => '', 'cep' => '', 'bootNumber' => '', 'pantsNumber' => '', 'shirtNumber' => '', 'markNumber' => '', 'number' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'Auxiliar','email' => 'auxiliar','password' => '123', 'profile_id' => '10', 'construction_id' => '1', 'cpf' => '398.253.600-62', 'job_id' => '8', 'ctps' => '', 'rg' => '291710384', 'phoneMobile' => '', 'mobileAlternative' => '', 'birthDate' => '1990/12/05 00:00:01', 'pcd' => '1', 'motherName' => '', 'address' => '', 'addressNumber' => '', 'addressExtra' => '', 'neighborhood' => '', 'city' => '', 'states' => '', 'cep' => '', 'bootNumber' => '', 'pantsNumber' => '', 'shirtNumber' => '', 'markNumber' => '', 'number' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'Administrativo','email' => 'administrativo','password' => '123', 'profile_id' => '4', 'construction_id' => '1', 'cpf' => '373.627.120-49', 'job_id' => '9', 'ctps' => '', 'rg' => '202849764', 'phoneMobile' => '', 'mobileAlternative' => '', 'birthDate' => '1995/12/06 00:00:01', 'pcd' => '1', 'motherName' => '', 'address' => '', 'addressNumber' => '', 'addressExtra' => '', 'neighborhood' => '', 'city' => '', 'states' => '', 'cep' => '', 'bootNumber' => '', 'pantsNumber' => '', 'shirtNumber' => '', 'markNumber' => '', 'number' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'Matriz','email' => 'matriz','password' => '123', 'profile_id' => '3', 'construction_id' => '1', 'cpf' => '933.995.050-00', 'job_id' => '4', 'ctps' => '', 'rg' => '278158857', 'phoneMobile' => '', 'mobileAlternative' => '', 'birthDate' => '1996/02/05 00:00:01', 'pcd' => '1', 'motherName' => '', 'address' => '', 'addressNumber' => '', 'addressExtra' => '', 'neighborhood' => '', 'city' => '', 'states' => '', 'cep' => '', 'bootNumber' => '', 'pantsNumber' => '', 'shirtNumber' => '', 'markNumber' => '', 'number' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'Qualidade','email' => 'qualidade','password' => '123', 'profile_id' => '5', 'construction_id' => '1', 'cpf' => '566.053.160-10', 'job_id' => '9', 'ctps' => '', 'rg' => '463210013', 'phoneMobile' => '', 'mobileAlternative' => '', 'birthDate' => '1996/02/05 00:00:01', 'pcd' => '1', 'motherName' => '', 'address' => '', 'addressNumber' => '', 'addressExtra' => '', 'neighborhood' => '', 'city' => '', 'states' => '', 'cep' => '', 'bootNumber' => '', 'pantsNumber' => '', 'shirtNumber' => '', 'markNumber' => '', 'number' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'RH','email' => 'rh','password' => '123', 'profile_id' => '8', 'construction_id' => '1', 'cpf' => '671.720.140-14', 'job_id' => '9', 'ctps' => '', 'rg' => '110429692', 'phoneMobile' => '', 'mobileAlternative' => '', 'birthDate' => '1996/02/05 00:00:01', 'pcd' => '1', 'motherName' => '', 'address' => '', 'addressNumber' => '', 'addressExtra' => '', 'neighborhood' => '', 'city' => '', 'states' => '', 'cep' => '', 'bootNumber' => '', 'pantsNumber' => '', 'shirtNumber' => '', 'markNumber' => '', 'number' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'SMS','email' => 'sms','password' => '123', 'profile_id' => '6', 'construction_id' => '1', 'cpf' => '046.650.220-62', 'job_id' => '4', 'ctps' => '', 'rg' => '261158247', 'phoneMobile' => '', 'mobileAlternative' => '', 'birthDate' => '1996/02/05 00:00:01', 'pcd' => '1', 'motherName' => '', 'address' => '', 'addressNumber' => '', 'addressExtra' => '', 'neighborhood' => '', 'city' => '', 'states' => '', 'cep' => '', 'bootNumber' => '', 'pantsNumber' => '', 'shirtNumber' => '', 'markNumber' => '', 'number' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('people')->insert(['name' => 'Supervisor','email' => 'supervisor','password' => '123', 'profile_id' => '7', 'construction_id' => '1', 'cpf' => '190.717.240-85', 'job_id' => '2', 'ctps' => '', 'rg' => '465840723', 'phoneMobile' => '', 'mobileAlternative' => '', 'birthDate' => '1996/02/05 00:00:01', 'pcd' => '1', 'motherName' => '', 'address' => '', 'addressNumber' => '', 'addressExtra' => '', 'neighborhood' => '', 'city' => '', 'states' => '', 'cep' => '', 'bootNumber' => '', 'pantsNumber' => '', 'shirtNumber' => '', 'markNumber' => '', 'number' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }
}