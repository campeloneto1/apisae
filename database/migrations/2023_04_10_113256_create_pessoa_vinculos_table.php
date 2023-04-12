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
        Schema::create('pessoas_vinculos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('vinculo_tipo_id')->nullable()->constrained('vinculos_tipos')->onUpdate('cascade')->onDelete('set null');
            $table->string('nome', 250); 
            $table->string('cpf', 11)->nullable();     
            $table->text('observacao')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();

            $table->unique(['pessoa_id', 'nome']);
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas_vinculos');
    }
};
