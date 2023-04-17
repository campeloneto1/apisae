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
        Schema::create('arquivos_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50)->unique();

            $table->boolean('foto')->nullable();
            $table->boolean('video')->nullable();
            $table->boolean('texto')->nullable();
            $table->boolean('pdf')->nullable();
            $table->boolean('audio')->nullable();
            $table->boolean('link')->nullable();

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
        Schema::dropIfExists('arquivos_tipos');
    }
};
