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
        Schema::create('investigacoes_sociais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas')->onUpdate('cascade')->onDelete('set null');
            $table->string('matricula', 8)->nullable();
            $table->string('numeral', 8)->nullable();
            $table->date('data_ingresso')->nullable();
            $table->foreignId('graduacao_id')->nullable()->constrained('graduacoes')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('companhia_id')->nullable()->constrained('companhias')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('situacao_funcional_id')->nullable()->constrained('situacoes_funcionais')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('situacao_tipo_id')->nullable()->constrained('situacoes_tipos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('comportamento_id')->nullable()->constrained('comportamentos')->onUpdate('cascade')->onDelete('set null');

            $table->text('sip')->nullable();
            $table->text('sinesp')->nullable();
            $table->text('tjce')->nullable();
            $table->text('fontes_abertas')->nullable();
            $table->text('informacoes_adicionais')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investigacao_socials');
    }
};
