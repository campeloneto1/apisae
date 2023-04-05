<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CnhCategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'A'],
            1 => ['nome' => 'B'],
            2 => ['nome' => 'C'],
            3 => ['nome' => 'D'],
            4 => ['nome' => 'E'],
            5 => ['nome' => 'AB'],
            6 => ['nome' => 'AC'],
            7 => ['nome' => 'AD'],
            8 => ['nome' => 'AE']
        ];
        DB::table('cnh_categorias')->insert($init);
    }
}
