<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('texto', 350)->nullable();
            $table->foreignId('programacao_id')->constrained('programacoes')->onDelete('cascade');
            $table->string('imagem_path_1')->nullable();
            $table->string('imagem_path_2')->nullable();
            $table->string('imagem_path_3')->nullable();
            $table->string('imagem_path_4')->nullable();
            $table->string('imagem_path_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
