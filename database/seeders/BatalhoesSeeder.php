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
            0 => ['nome' => '1º Batalhão da PM', 'abreviatura' => '1º BPM'],
            1 => ['nome' => '2º Batalhão da PM', 'abreviatura' => '2º BPM'],
            2 => ['nome' => '3º Batalhão da PM', 'abreviatura' => '3º BPM'],
            3 => ['nome' => '4º Batalhão da PM', 'abreviatura' => '4º BPM'],
            4 => ['nome' => '5º Batalhão da PM', 'abreviatura' => '5º BPM'],
            5 => ['nome' => '6º Batalhão da PM', 'abreviatura' => '6º BPM'],
            6 => ['nome' => '7º Batalhão da PM', 'abreviatura' => '7º BPM'],
            7 => ['nome' => '8º Batalhão da PM', 'abreviatura' => '8º BPM'],
        ];
        DB::table('batalhoes')->insert($init);
    }
}
