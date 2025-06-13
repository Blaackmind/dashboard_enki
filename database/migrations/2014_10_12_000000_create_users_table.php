<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 1. Tabela de Usuários (alterada com campo perfil)
return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('perfil', ['admin', 'leitor', 'bibliotecario'])->default('leitor');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

// 2. Tabela de Livros
Schema::create('livros', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->string('autor');
    $table->string('categoria');
    $table->year('ano_publicacao');
    $table->text('descricao')->nullable();
    $table->timestamps();
});

// 3. Tabela de Empréstimos
Schema::create('emprestimos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('livro_id')->constrained()->onDelete('cascade');
    $table->date('data_emprestimo');
    $table->date('data_devolucao_prevista');
    $table->timestamps();
});

// 4. Tabela de Devoluções
Schema::create('devolucoes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('emprestimo_id')->constrained()->onDelete('cascade');
    $table->date('data_devolucao_real');
    $table->boolean('em_atraso')->default(false);
    $table->timestamps();
});

// 5. Tabela de Favoritos
Schema::create('favoritos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('livro_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});

// 6. Tabela de Comentários
Schema::create('comentarios', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('livro_id')->constrained()->onDelete('cascade');
    $table->text('comentario');
    $table->timestamps();
});

// 7. Tabela de Multas
Schema::create('multas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('devolucao_id')->constrained()->onDelete('cascade');
    $table->decimal('valor', 8, 2);
    $table->boolean('pago')->default(false);
    $table->timestamps();
});