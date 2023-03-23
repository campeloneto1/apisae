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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('alcunha', 50)->nullable();
            $table->string('cpf', 15)->unique();
            $table->date('data_nascimento')->nullable();
            $table->string('mae', 100)->nullable();
            $table->string('pai', 100)->nullable();
            $table->foreignId('sexo_id')->nullable()->constrained('sexos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('influencia_id')->nullable()->constrained('influencias')->onUpdate('cascade')->onDelete('set null');
            
            $table->string('telefone1', 20)->nullable();
            $table->string('telefone2', 20)->nullable();
            $table->string('email', 100)->unique()->nullable();

            $table->string('cep', 10)->nullable();
            $table->foreignId('cidade_id')->nullable()->constrained('cidades')->onUpdate('cascade')->onDelete('set null');

            $table->string('rua', 50)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('complemento', 100)->nullable();

            $table->text('observacao')->nullable();
        
            $table->string('key', 100)->nullable();
            $table->string('foto', 100)->nullable();

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
        Schema::dropIfExists('pessoas');
    }
};
