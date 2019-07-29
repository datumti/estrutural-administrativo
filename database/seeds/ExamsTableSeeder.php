<?php

use Illuminate\Database\Seeder;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Exam::class, 10)->create();

        DB::table('exams')->insert(['description' => '', 'name' => 'HEMOGRAMA COMPLETO COM PLAQUETAS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90, 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'URE-UREIA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'ESPIROMETRIA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'RX TORAX', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'Glicemia(jejum),transaminase,Creatinina', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'TIPAGEM SANGUINEA+FATOR RH', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'VACINACAO ANTI-TETANICA 0-30-60', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'HCV Ac. Anti-HCV', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'EEG (ELETROENCEFALOGRAMA )', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'IMUNIZACAO HEPATITE A', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'INDICADOR BIOLOGICO DE EXPOSICAO (IBE)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'GLICEMIA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'HIV 1+2 ANTICORPOS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'GGT (Gama GT)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'IMUNIZACAO ANTI HBS-HBC-HCV-HBSAG', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'UREIA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'EQU-EXAME QUALITATIVO DE URINA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'OFTALMOLOGICO COMPLETO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'AUDIOMETRIA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'AUDIOMETRIA APÓS 6 MESES', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'CLÍNICO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'ECG (ELETROCARDIOGRAMA)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'TGO (TRANSAMINASE GLUTÂMICO OXALACÉTICA)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'TGP (TRANSAMINASE GLUTÂMICO PIRÚVICA)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'ACUIDADE VISUAL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'AVALIAÇÃO PSICOSSOCIAL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'AUDIOMETRIA TONAL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'ACIDO HIPURICO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'GRUPO SANGUINIO/FATOR RH', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'RX COLUNA LOMBO E SACRA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'HEMOGRAMA/PLAQUETAS/RETÍCULOCITOS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'GLICEMIA EM JEJUM', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'ELETROCARDIOGRAMA EM REPOUSO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'RETICULOCITOS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'ACIDO TRANS-TRANS MUCONICO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => '2,5-HEXANODIONA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'TESTE ERGOMÉTRICO ACIMA DE 50ANOS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'OTONEUROLOGICO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'MERCURIO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'ALUMINIO/ZINCO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'CHUMBO E ALA-U', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'NIQUEL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'CROMO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'MANGANES', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'CREATININA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'AVALIAÇÃO BUCAL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'HEMOGRAMA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'HEMOGRAMA COMPLETO, RETICULOCITOS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'Anti-HBs,Anti-HBc,Anti-HCV, HBsAg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'PLAQUETAS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'TESTE DE ROMBERG', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'SUMARIO DE URINA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'COLESTEROL TOTAL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'TRIGLICERIDES', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'URINA I (EAS)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'RX TORAX E PERFIL ESQUERDO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'ÁCIDO METIL HIPÚRICO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
        DB::table('exams')->insert(['description' => '', 'name' => 'EXAME TOXICOLÓGICO PARA O CAGED', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'expiration' => 90]);
    }
}
