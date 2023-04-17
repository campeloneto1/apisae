<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RedesSociaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'Facebook'],
            1 => ['nome' => 'Instagram'],
            2 => ['nome' => 'Twitter'],
            2 => ['nome' => 'Youtube']
        ];
        DB::table('redes_sociais')->insert($init);
    }
}
