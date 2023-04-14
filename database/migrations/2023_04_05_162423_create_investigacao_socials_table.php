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
        Schema::create('investigacoes_sociais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->nullable()->unique()->constrained('pessoas')->onUpdate('cascade')->onDelete('set null');
            $table->string('nome_guerra', 40)->nullable();
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

            $table->foreignId('indicou_id')->nullable()->constrained('pessoas')->onUpdate('cascade')->onDelete('set null');
            
            $table->foreignId('investigacao_social_status_id')->nullable()->constrained('investigacoes_sociais_status')->onUpdate('cascade')->onDelete('set null');
            $table->string('bcg_transferencia')->nullable();            
            $table->foreignId('encaminhou_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');

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
        Schema::dropIfExists('investigacao_socials');
    }
};
