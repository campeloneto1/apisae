<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     php artisan migrate:fresh --seed
     * php artisan passport:install
     * php artisan key:generate
     * Seed the application's database.

    UPDATE `perfis` SET 
    `administrador`= 1,`gestor`= 1,`restrito`= 1,`relatorios`= 1,
    `users`= 1,`users_cad`= 1,`users_edt`= 1,`users_del`= 1,
    `analises`= 1,`analises_cad`= 1,`analises_edt`= 1,`analises_del`= 1, 
    `investigacoes_sociais`= 1,`investigacoes_sociais_cad`= 1,`investigacoes_sociais_edt`= 1,`investigacoes_sociais_del`= 1, 
    `organizacoes`= 1,`organizacoes_cad`= 1,`organizacoes_edt`= 1,`organizacoes_del`= 1, 
    `pessoas`= 1,`pessoas_cad`= 1,`pessoas_edt`= 1,`pessoas_del`= 1,
    `veiculos`= 1,`veiculos_cad`= 1,`veiculos_edt`= 1,`veiculos_del`= 1  
     WHERE `id` = 1
     *
     * @return void
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        $this->call([          
            //CoresSeeder::class,  
            //InfluenciasSeeder::class, 
            //RedesSociaisSeeder::class, 
            BatalhoesSeeder::class,
            CnhCategoriasSeeder::class,
            CompanhiasSeeder::class,
            ComportamentosSeeder::class,
            EscolaridadesSeeder::class,
            GraduacoesSeeder::class,
            SituacoesFuncionaisSeeder::class,
            SituacoesTiposSeeder::class,
            ArquivosTiposSeeder::class,
            SexosSeeder::class,
            PaisesSeeder::class,
            EstadosSeeder::class,
            PerfisSeeder::class, 
            UsersSeeder::class,            
        ]);
        Schema::enableForeignKeyConstraints();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
