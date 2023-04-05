<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GraduacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'Soldado', 'abreviatura' => 'SD'],
            1 => ['nome' => 'Cabo', 'abreviatura' => 'CB'],
            2 => ['nome' => '3º Sargento', 'abreviatura' => '3º SGT'],
            3 => ['nome' => '2º Sargento', 'abreviatura' => '2º SGT'],
            4 => ['nome' => '1º Sargento', 'abreviatura' => '1º SGT'],
            5 => ['nome' => 'SubTenente', 'abreviatura' => 'ST'],
            6 => ['nome' => '2º Tenente', 'abreviatura' => '2º Ten'],
            7 => ['nome' => '1º Tenente', 'abreviatura' => '1º Ten'],
            8 => ['nome' => 'Capitão', 'abreviatura' => 'Cap'],
            9 => ['nome' => 'Major', 'abreviatura' => 'Maj'],
            10 => ['nome' => 'Tenente-Coronel', 'abreviatura' => 'TC'],
            11 => ['nome' => 'Coronel', 'abreviatura' => 'Cel'],
        ];
        DB::table('graduacoes')->insert($init);
    }
}
