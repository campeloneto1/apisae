<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArquivosTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'Foto', 'foto' => 1, 'video' => 0, 'texto' => 0, 'pdf' => 0, 'audio' => 0],           
            1 => ['nome' => 'Texto', 'foto' => 0, 'video' => 0, 'texto' => 1, 'pdf' => 0, 'audio' => 0],
            2 => ['nome' => 'PDF', 'foto' => 0, 'video' => 0, 'texto' => 0, 'pdf' => 1, 'audio' => 0],
            
        ];
        DB::table('arquivos_tipos')->insert($init);
    }
}
