<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComportamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'Excelente'],
            1 => ['nome' => 'Ótimo'],
            2 => ['nome' => 'Bom'],
            3 => ['nome' => 'Regular'],
            4 => ['nome' => 'Ruim'],
       
        ];
        DB::table('comportamentos')->insert($init);
    }
}
