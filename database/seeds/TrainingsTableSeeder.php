<?php

use Illuminate\Database\Seeder;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Training::class, 10)->create();

        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 33 - CURSO DE RECICLAGEM DE TRABALHADORES / NR 33 - VIGIA DE ESPAÇO CONFINADO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 10 - Seg. em Instalações e Serv. de Eletricidade - Reciclagem', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 33 - CURSO DE FORMAÇÃO DE TRABALHADORES / NR 33 - VIGIA DE ESPAÇO CONFINADO ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 10 -  40 HORAS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 35 RECICLAGEM - TRABALHO EM ALTURA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 20 - FORMAÇÃO DE MULTIPLICADORES INTERNOS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'INTEGRAÇÃO ESTRUTURAL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 20 - CURSO INTERMEDIÁRIO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'CURSO DE FORMAÇÃO DE OPERAÇÃO DE PONTE ROLANTE', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 20 - CURSO ESPECÍFICO NR-20', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 34 - TREINAMENTO ADMISSIONAL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'DDSMS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'DSS - Diálogo Semanal de Segurança', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'PPR INTEGRAÇÃO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'PCA INTEGRAÇÃO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 20 - CURSO DE RECICLAGEM', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 35 - PRÁTICO: CURSO DE FORMAÇÃO DE TRABALHO EM ALTURA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 35 - CURSO DE FORMAÇÃO DE TRABALHO EM ALTURA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'CURSO DE SEGURANÇA SAUDE EM ESPAÇO CONFINADO SUPERVISOR', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'INTEGRAÇÃO PETROBRAS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'SALVATAGEM', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 20 - CURSO BÁSICO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('trainings')->insert(['description' => '', 'name' => 'NR 34 - RECICLAGEM - RISCOS AMBIENTAIS E REPAROS NAVAIS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }
}
