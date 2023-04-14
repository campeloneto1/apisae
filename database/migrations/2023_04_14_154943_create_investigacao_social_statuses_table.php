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
        Schema::create('investigacoes_sociais_status', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50)->unique();
            $table->boolean('andamento')->nullable();
            $table->boolean('concluido')->nullable();
            $table->boolean('encaminhado')->nullable();
            $table->boolean('aprovado')->nullable();
            $table->boolean('recusado')->nullable();
            $table->boolean('aguardando')->nullable();
            $table->boolean('transferido')->nullable();
            

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
        Schema::dropIfExists('investigacoes_sociais_status');
    }
};
