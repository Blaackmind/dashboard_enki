<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('devolucoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emprestimo_id')->constrained('emprestimos')->onDelete('cascade');
            $table->date('data_devolucao_real');
            $table->boolean('em_atraso')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('devolucoes');
    }
}; 