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
            $table->boolean('administrador')->nullable();
            $table->boolean('gestor')->nullable();
            $table->boolean('restrito')->nullable();
            $table->boolean('relatorios')->nullable();       

            $table->boolean('users')->nullable();        
            $table->boolean('users_cad')->nullable();  
            $table->boolean('users_edt')->nullable();  
            $table->boolean('users_del')->nullable();     

            $table->boolean('analises')->nullable();        
            $table->boolean('analises_cad')->nullable();  
            $table->boolean('analises_edt')->nullable();  
            $table->boolean('analises_del')->nullable();            

            $table->boolean('organizacoes')->nullable();        
            $table->boolean('organizacoes_cad')->nullable();  
            $table->boolean('organizacoes_edt')->nullable();  
            $table->boolean('organizacoes_del')->nullable();  

            $table->boolean('pessoas')->nullable();        
            $table->boolean('pessoas_cad')->nullable();  
            $table->boolean('pessoas_edt')->nullable();  
            $table->boolean('pessoas_del')->nullable();  

            $table->boolean('investigacoes_sociais')->nullable();        
            $table->boolean('investigacoes_sociais_cad')->nullable();  
            $table->boolean('investigacoes_sociais_edt')->nullable();  
            $table->boolean('investigacoes_sociais_del')->nullable();   

            $table->boolean('veiculos')->nullable();        
            $table->boolean('veiculos_cad')->nullable();  
            $table->boolean('veiculos_edt')->nullable();  
            $table->boolean('veiculos_del')->nullable();                          

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
