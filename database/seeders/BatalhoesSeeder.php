<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatalhoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => '1º Batalhão', 'abreviatura' => '1º BPM'],
            1 => ['nome' => '2º Batalhão', 'abreviatura' => '2º BPM'],
            2 => ['nome' => '3º Batalhão', 'abreviatura' => '3º BPM'],
            3 => ['nome' => '4º Batalhão', 'abreviatura' => '4º BPM'],
            4 => ['nome' => '5º Batalhão', 'abreviatura' => '5º BPM'],
            5 => ['nome' => '6º Batalhão', 'abreviatura' => '6º BPM'],
            6 => ['nome' => '7º Batalhão', 'abreviatura' => '7º BPM'],
            7 => ['nome' => '8º Batalhão', 'abreviatura' => '8º BPM'],
            8 => ['nome' => '9º Batalhão', 'abreviatura' => '9º BPM'],
            9 => ['nome' => '10º Batalhão', 'abreviatura' => '10º BPM'],
            10 => ['nome' => '11º Batalhão', 'abreviatura' => '11º BPM'],
            11 => ['nome' => '12º Batalhão', 'abreviatura' => '12º BPM'],
            12 => ['nome' => '13º Batalhão', 'abreviatura' => '13º BPM'],
            13 => ['nome' => '14º Batalhão', 'abreviatura' => '14º BPM'],
            14 => ['nome' => '15º Batalhão', 'abreviatura' => '15º BPM'],
            15 => ['nome' => '16º Batalhão', 'abreviatura' => '16º BPM'],
            16 => ['nome' => '17º Batalhão', 'abreviatura' => '17º BPM'],
            17 => ['nome' => '18º Batalhão', 'abreviatura' => '18º BPM'],
            18 => ['nome' => '19º Batalhão', 'abreviatura' => '19º BPM'],
            19 => ['nome' => '20º Batalhão', 'abreviatura' => '20º BPM'],
            20 => ['nome' => '21º Batalhão', 'abreviatura' => '21º BPM'],
            21 => ['nome' => '22º Batalhão', 'abreviatura' => '22º BPM'],
            22 => ['nome' => '23º Batalhão', 'abreviatura' => '23º BPM'],
            23 => ['nome' => '24º Batalhão', 'abreviatura' => '24º BPM'],
            24 => ['nome' => '25º Batalhão', 'abreviatura' => '25º BPM'],
            25 => ['nome' => 'Batalhão Policiamento de Choque', 'abreviatura' => 'BPCHOQUE'],
            26 => ['nome' => 'Batalhão Plociamento Raio', 'abreviatura' => 'BPRAIO'],
            27 => ['nome' => 'Quartel do Comando Geral', 'abreviatura' => 'QCG'],
            28 => ['nome' => 'Casa Militar', 'abreviatura' => 'CM'],
           
        ];
        DB::table('batalhoes')->insert($init);
    }
}
