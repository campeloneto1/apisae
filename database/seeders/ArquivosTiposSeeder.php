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
            0 => ['nome' => 'Foto', 'foto' => 1, 'video' => 0, 'texto' => 0, 'pdf' => 0, 'audio' => 0, 'link' => 0],           
            1 => ['nome' => 'Vídeo', 'foto' => 0, 'video' => 1, 'texto' => 0, 'pdf' => 0, 'audio' => 0, 'link' => 0],
            2 => ['nome' => 'Áudio', 'foto' => 0, 'video' => 0, 'texto' => 0, 'pdf' => 0, 'audio' => 1, 'link' => 0],
            3 => ['nome' => 'PDF', 'foto' => 0, 'video' => 0, 'texto' => 0, 'pdf' => 0, 'audio' => 0, 'link' => 0],
            4 => ['nome' => 'DOC', 'foto' => 0, 'video' => 0, 'texto' => 1, 'pdf' => 0, 'audio' => 1, 'link' => 0],
            5 => ['nome' => 'Link', 'foto' => 0, 'video' => 0, 'texto' => 0, 'pdf' => 0, 'audio' => 0, 'link' => 1],
            
        ];
        DB::table('arquivos_tipos')->insert($init);
    }
}
