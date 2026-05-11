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
    Schema::create('livros', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');

        $table->string('titulo');

        $table->string('autor');

        $table->string('editora')->nullable();

        $table->integer('ano_publicacao')->nullable();

        $table->string('genero')->nullable();

        $table->text('resumo');

        $table->string('imagem')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
