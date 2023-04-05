<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanhiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['batalhao_id' => 1,'nome' => '1º Companhia da PM', 'abreviatura' => '1º CIA'],
            1 => ['batalhao_id' => 1,'nome' => '2º Companhia da PM', 'abreviatura' => '2º CIA'],
            2 => ['batalhao_id' => 1,'nome' => '3º Companhia da PM', 'abreviatura' => '3º CIA'],
            3 => ['batalhao_id' => 1,'nome' => '4º Companhia da PM', 'abreviatura' => '4º CIA'],
            4 => ['batalhao_id' => 2,'nome' => '1º Companhia da PM', 'abreviatura' => '1º CIA'],
            5 => ['batalhao_id' => 2,'nome' => '2º Companhia da PM', 'abreviatura' => '2º CIA'],
            6 => ['batalhao_id' => 2,'nome' => '3º Companhia da PM', 'abreviatura' => '3º CIA'],
            7 => ['batalhao_id' => 2,'nome' => '4º Companhia da PM', 'abreviatura' => '4º CIA'],
        ];
        DB::table('companhias')->insert($init);
    }
}
