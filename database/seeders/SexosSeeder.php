<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => [ 'nome' => 'Masculino' ],
            1 => [ 'nome' => 'Feminino' ],
            2 => [ 'nome' => 'Prefere não informar' ],
          
        ];
        DB::table('sexos')->insert($init);
    }
}
