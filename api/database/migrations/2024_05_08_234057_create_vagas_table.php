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
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('descricao_curta', 60)->comment('Descrição curta da vaga');
            $table->text('descricao_longa')->nullable(true)->comment('Descrição longa (não obrigatória) da vaga');
            $table->unsignedBigInteger('remuneracao')->comment('Informativo do valor (int) que será pago pelo trabalho');
            $table->string('cep', 8)->comment('CEP (localização) de onde o trabalho deve ser feito');
            $table->unsignedBigInteger('user_id')->comment('Usuário que cadastrou a vaga');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas');
    }
};
