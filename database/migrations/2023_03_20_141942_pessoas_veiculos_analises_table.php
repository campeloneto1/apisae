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
        /*Schema::disableForeignKeyConstraints();
        Schema::create('pessoas_veiculos_analises', function (Blueprint $table) {
             $table->id();
            $table->foreignId('analise_id')->nullable()->constrained('analises')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('veiculo_id')->nullable()->constrained('veiculos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('organizacao_id')->nullable()->constrained('organizacoes')->onUpdate('cascade')->onDelete('set null');

            $table->date('data')->nullable();
            $table->time('hora')->nullable();

            $table->boolean('lider')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};