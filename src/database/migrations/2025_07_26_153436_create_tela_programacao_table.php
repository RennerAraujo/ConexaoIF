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
        Schema::create('tela_programacao', function (Blueprint $table) {
            $table->foreignId('tela_id')->constrained('telas')->onDelete('cascade');

            $table->foreignId('programacao_id')->constrained('programacoes')->onDelete('cascade');

            $table->primary(['tela_id', 'programacao_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tela_programacao');
    }
};
