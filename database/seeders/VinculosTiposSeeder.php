<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VinculosTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'Mãe'],
            1 => ['nome' => 'Pai'],
            2 => ['nome' => 'Irmão'],
            3 => ['nome' => 'Irmã'],
            4 => ['nome' => 'Filho'],
            5 => ['nome' => 'Filha'],
            6 => ['nome' => 'Conjuge'],
            7 => ['nome' => 'Tio'],
            8 => ['nome' => 'Tia'],
            9 => ['nome' => 'Avô'],
            //10 => ['nome' => 'Avó']
        ];
        DB::table('vinculos_tipos')->insert($init);
    }
}
