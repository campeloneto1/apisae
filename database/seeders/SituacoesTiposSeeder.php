<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituacoesTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $init = [
            0 => [ 'nome' => 'Na Ativa' ],
            1 => [ 'nome' => 'Na Reserva' ],
          
        ];
        DB::table('situacoes_tipos')->insert($init);
    }
}
