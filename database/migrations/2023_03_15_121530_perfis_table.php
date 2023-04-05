<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('perfis', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->unique();   
            $table->boolean('administrador')->default(0);
            $table->boolean('gestor')->default(0);
            $table->boolean('restrito')->default(0);
            $table->boolean('relatorios')->default(0);       

            $table->boolean('users')->default(0);        
            $table->boolean('users_cad')->default(0);  
            $table->boolean('users_edt')->default(0);  
            $table->boolean('users_del')->default(0);     

            $table->boolean('analises')->default(0);        
            $table->boolean('analises_cad')->default(0);  
            $table->boolean('analises_edt')->default(0);  
            $table->boolean('analises_del')->default(0);            

            $table->boolean('organizacoes')->default(0);        
            $table->boolean('organizacoes_cad')->default(0);  
            $table->boolean('organizacoes_edt')->default(0);  
            $table->boolean('organizacoes_del')->default(0);  

            $table->boolean('pessoas')->default(0);        
            $table->boolean('pessoas_cad')->default(0);  
            $table->boolean('pessoas_edt')->default(0);  
            $table->boolean('pessoas_del')->default(0);  

            $table->boolean('investigacoes_sociais')->default(0);        
            $table->boolean('investigacoes_sociais_cad')->default(0);  
            $table->boolean('investigacoes_sociais_edt')->default(0);  
            $table->boolean('investigacoes_sociais_del')->default(0);   

            $table->boolean('veiculos')->default(0);        
            $table->boolean('veiculos_cad')->default(0);  
            $table->boolean('veiculos_edt')->default(0);  
            $table->boolean('veiculos_del')->default(0);                          

               

            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfis');
    }
};
