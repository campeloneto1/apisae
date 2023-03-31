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

            $table->boolean('foto')->default(0);
            $table->boolean('video')->default(0);
            $table->boolean('texto')->default(0);
            $table->boolean('pdf')->default(0);
            $table->boolean('audio')->default(0);

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
