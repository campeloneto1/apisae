<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvestigacaoSocialStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $init = [
            0 => [ 'nome' => 'Em Andamento', 'andamento' => 1, 'concluido' => 0, 'encaminhado' => 0, 'aprovado' => 0, 'recusado' => 0, 'aguardando' => 0, 'transferido' => 0 ],
            1 => [ 'nome' => 'Concluído', 'andamento' => 0, 'concluido' => 1, 'encaminhado' => 0, 'aprovado' => 0, 'recusado' => 0, 'aguardando' => 0, 'transferido' => 0 ],
            2 => [ 'nome' => 'Encaminhado', 'andamento' => 0, 'concluido' => 0, 'encaminhado' => 1, 'aprovado' => 0, 'recusado' => 0, 'aguardando' => 0, 'transferido' => 0 ],
            3 => [ 'nome' => 'Aprovado', 'andamento' => 0, 'concluido' => 0, 'encaminhado' => 0, 'aprovado' => 1, 'recusado' => 0, 'aguardando' => 0, 'transferido' => 0 ],
            4 => [ 'nome' => 'Recusado', 'andamento' => 0, 'concluido' => 0, 'encaminhado' => 0, 'aprovado' => 0, 'recusado' => 1, 'aguardando' => 0, 'transferido' => 0 ],
            5 => [ 'nome' => 'Aguardando Transf.', 'andamento' => 0, 'concluido' => 0, 'encaminhado' => 0, 'aprovado' => 0, 'recusado' => 0, 'aguardando' => 0, 'transferido' => 0 ],
            6 => [ 'nome' => 'Transferido', 'andamento' => 1, 'concluido' => 0, 'encaminhado' => 0, 'aprovado' => 0, 'recusado' => 0, 'aguardando' => 0, 'transferido' => 1 ],
          
        ];
        DB::table('investigacoes_sociais_status')->insert($init);    
    }
}
