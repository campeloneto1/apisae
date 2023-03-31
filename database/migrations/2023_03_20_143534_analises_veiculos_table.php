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
        Schema::create('analises_veiculos', function (Blueprint $table) {
             $table->id();
            $table->foreignId('analise_id')->nullable()->constrained('analises')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('veiculo_id')->nullable()->constrained('veiculos')->onUpdate('cascade')->onDelete('set null');

            //$table->date('data')->nullable();
            //$table->time('hora')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();

            $table->unique(['veiculo_id', 'analise_id']);
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analises_veiculos');
    }
};
