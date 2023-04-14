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
        Schema::create('investigacoes_sociais_cgds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investigacao_social_id')->nullable()->constrained('investigacoes_sociais')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('cgd_envolvimento_tipo_id')->nullable()->constrained('cgds_envolvimentos_tipos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('cgd_processo_tipo_id')->nullable()->constrained('cgds_processos_tipos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('cgd_situacao_tipo_id')->nullable()->constrained('cgds_situacoes_tipos')->onUpdate('cascade')->onDelete('set null');
            $table->string('spu', 50); 
            $table->text('descricao')->nullable();

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
        Schema::dropIfExists('investigacoes_sociais_cgds');
    }
};
