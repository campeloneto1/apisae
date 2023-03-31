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
        Schema::create('analises', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->unique();
            $table->date('data');
            $table->time('hora');
            $table->foreignId('analise_categoria_id')->nullable()->constrained('analises_categorias')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('analise_tipo_id')->nullable()->constrained('analises_tipos')->onUpdate('cascade')->onDelete('set null');
       
            $table->string('cep', 10)->nullable();
            $table->foreignId('cidade_id')->nullable()->constrained('cidades')->onUpdate('cascade')->onDelete('set null');

            $table->string('rua', 50)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('complemento', 100)->nullable();

            $table->text('observacao')->nullable();
            $table->text('previa')->nullable();
            $table->text('sintese')->nullable();
        
            $table->string('key', 100)->nullable();

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
        //
    }
};
