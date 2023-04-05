<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscolaridadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'Fundamental Incompleto'],
            1 => ['nome' => 'Fundamental Completo'],
            2 => ['nome' => 'Médio Incompleto'],
            3 => ['nome' => 'Médio Completo'],
            4 => ['nome' => 'Superior Incompleto'],
            5 => ['nome' => 'Superior Completo'],
            6 => ['nome' => 'Pós-Graduação Incompleto'],
            7 => ['nome' => 'Pós-Graduação Completo'],
            8 => ['nome' => 'Mestrado Incompleto'],
            9 => ['nome' => 'Mestrado Completo'],
            10 => ['nome' => 'Doutorado Incompleto'],
            11 => ['nome' => 'Doutorado Completo'],
            12 => ['nome' => 'Analfabeto'],
       
        ];
        DB::table('escolaridades')->insert($init);
    }
}
