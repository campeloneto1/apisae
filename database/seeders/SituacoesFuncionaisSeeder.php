<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituacoesFuncionaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => [ 'nome' => 'Em Atividade' ],
            1 => [ 'nome' => 'Em Férias' ],
            2 => [ 'nome' => 'LTS' ],
          
        ];
        DB::table('situacoes_funcionais')->insert($init);
    }
}
