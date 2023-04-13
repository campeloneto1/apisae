<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CgdEnvolvimentoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'Investigado'],
            1 => ['nome' => 'Testemunha'],
           
        ];
        DB::table('cgds_envolvimentos_tipos')->insert($init);
    }
}
