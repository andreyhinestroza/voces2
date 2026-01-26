<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lista_video', function (Blueprint $table) {
            $table->id();

            // Llaves foráneas
            $table->unsignedBigInteger('lista_id');
            $table->unsignedBigInteger('video_id');

            // Índices
            $table->index('lista_id');
            $table->index('video_id');

            // Relaciones
            $table->foreign('lista_id')
                  ->references('id')
                  ->on('listas_reproduccion')
                  ->onDelete('cascade');

            $table->foreign('video_id')
                  ->references('id')
                  ->on('videos')
                  ->onDelete('cascade');

            // Evita duplicados en la misma lista
            $table->unique(['lista_id', 'video_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lista_video');
    }
};
