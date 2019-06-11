<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**1 */DB::table('permission')->insert(['local_access'=>'dashboard']);
        /**2 */DB::table('permission')->insert(['local_access'=>'gestao-de-obras']);
        /**3 */DB::table('permission')->insert(['local_access'=>'tecnica-grupo']);
        /**4 */DB::table('permission')->insert(['local_access'=>'tecnica-resultados']);
        /**5 */DB::table('permission')->insert(['local_access'=>'tecnica-anexos']);
        /**6 */DB::table('permission')->insert(['local_access'=>'tecnica-status-aprov-ressalva']);
        /**7 */DB::table('permission')->insert(['local_access'=>'psicossocial-grupo']);
        /**8 */DB::table('permission')->insert(['local_access'=>'psicossocial-resultados']);
        /**9 */DB::table('permission')->insert(['local_access'=>'psicossocial-anexos']);
        /**10*/DB::table('permission')->insert(['local_access'=>'psicossocial-status-aprov-ressalva']);
        /**11*/DB::table('permission')->insert(['local_access'=>'fsa-candidato']);
        /**12*/DB::table('permission')->insert(['local_access'=>'fsa-aprovacao']);
        /**13*/DB::table('permission')->insert(['local_access'=>'treinamentos-grupo']);
        /**14*/DB::table('permission')->insert(['local_access'=>'treinamentos-resultado']);
        /**15*/DB::table('permission')->insert(['local_access'=>'exame-grupo']);
        /**16*/DB::table('permission')->insert(['local_access'=>'exame-resultados']);
        /**17*/DB::table('permission')->insert(['local_access'=>'exame-anexos']);
        /**18*/DB::table('permission')->insert(['local_access'=>'cracha-grupo']);
        /**19*/DB::table('permission')->insert(['local_access'=>'cracha-resultados']);
        /**20*/DB::table('permission')->insert(['local_access'=>'candidatos-perfil']);
        /**21*/DB::table('permission')->insert(['local_access'=>'candidatos-remover']);
        /**22*/DB::table('permission')->insert(['local_access'=>'funcionarios']);
        /**23*/DB::table('permission')->insert(['local_access'=>'demissao-triagem']);
        /**24*/DB::table('permission')->insert(['local_access'=>'demissao-avaliacao']);
        /**25*/DB::table('permission')->insert(['local_access'=>'demissao-aprovacao']);
        /**26*/DB::table('permission')->insert(['local_access'=>'transferencia-triagem']);
        /**27*/DB::table('permission')->insert(['local_access'=>'transferencia-avaliacao']);
        /**28*/DB::table('permission')->insert(['local_access'=>'transferencia-aprovacao']);
        /**29*/DB::table('permission')->insert(['local_access'=>'cadastro-pessoas']);
        /**30*/DB::table('permission')->insert(['local_access'=>'cadastro-perfil']);
        /**31*/DB::table('permission')->insert(['local_access'=>'cadastro-cargos']);
        /**32*/DB::table('permission')->insert(['local_access'=>'restricao']);
        /**33*/DB::table('permission')->insert(['local_access'=>'efetivo-diario-importacao']);
        /**34*/DB::table('permission')->insert(['local_access'=>'efetivo-diario-relatorio']);
        /**35*/DB::table('permission')->insert(['local_access'=>'tecnica']);
        /**36*/DB::table('permission')->insert(['local_access'=>'psicossocial']);
        /**37*/DB::table('permission')->insert(['local_access'=>'fsa']);
        /**38*/DB::table('permission')->insert(['local_access'=>'treinamento']);
        /**39*/DB::table('permission')->insert(['local_access'=>'exame']);
        /**40*/DB::table('permission')->insert(['local_access'=>'cracha']);
        /**41*/DB::table('permission')->insert(['local_access'=>'processo-seletivo']);
        /**42*/DB::table('permission')->insert(['local_access'=>'gestao-de-pessoas']);
        /**43*/DB::table('permission')->insert(['local_access'=>'cadastro']);
        /**44*/DB::table('permission')->insert(['local_access'=>'efetivo-diario']);
        /**45*/DB::table('permission')->insert(['local_access'=>'fsa-candidato']);
        /**46*/DB::table('permission')->insert(['local_access'=>'fsa-competencia']);
        /**47*/DB::table('permission')->insert(['local_access'=>'fsa-qualidade']);
        /**48*/DB::table('permission')->insert(['local_access'=>'fsa-administrativo']);
        /**49*/DB::table('permission')->insert(['local_access'=>'fsa-gerente']);
        /**50*/DB::table('permission')->insert(['local_access'=>'cadastro-treinamento']);
        /**51*/DB::table('permission')->insert(['local_access'=>'cadastro-exames']);
        /**52*/DB::table('permission')->insert(['local_access'=>'demissao']);
        /**53*/DB::table('permission')->insert(['local_access'=>'demissao-anexos']);
        /**54*/DB::table('permission')->insert(['local_access'=>'demissao-avaliacao']);
    }
}