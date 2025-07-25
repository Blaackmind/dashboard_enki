<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('multas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('devolucao_id')->constrained('devolucoes')->onDelete('cascade');
            $table->decimal('valor', 8, 2);
            $table->boolean('pago')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('multas');
    }
}; 