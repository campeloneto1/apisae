<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CgdSituacaoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $init = [
            0 => ['nome' => 'Em Andamento'],            
            1 => ['nome' => 'Arquivado'],            
            2 => ['nome' => 'Arquivado por Prescrição'],            
        ];
        DB::table('cgds_situacoes_tipos')->insert($init);
    }
}
