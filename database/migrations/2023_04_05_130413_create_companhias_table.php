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
        Schema::create('companhias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batalhao_id')->nullable()->constrained('batalhoes')->onUpdate('cascade')->onDelete('set null');
            $table->string('nome', 50);
            $table->string('abreviatura', 20);

            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();

            $table->unique(['batalhao_id', 'nome']);
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companhias');
    }
};
