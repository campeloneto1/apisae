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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();

            //$table->string('codigo', 50)->nullable();
            $table->string('placa', 15)->unique();
            $table->string('renavam', 50)->nullable();
            $table->string('chassi', 50)->nullable();
            $table->integer('ano')->nullable();
            $table->foreignId('cor_id')->nullable()->constrained('cores')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('modelo_id')->nullable()->constrained('modelos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('veiculo_tipo_id')->nullable()->constrained('veiculos_tipos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('organizacao_id')->nullable()->constrained('organizacoes')->onUpdate('cascade')->onDelete('set null');

            $table->text('observacao')->nullable();

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
        Schema::dropIfExists('veiculos');
    }
};
