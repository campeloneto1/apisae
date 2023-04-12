<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LotacoesTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => [ 'nome' => 'Transferência' ],
            1 => [ 'nome' => 'Mudança de LOB' ],
          
        ];
        DB::table('lotacoes_tipos')->insert($init);
    }
}
