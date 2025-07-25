<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livro;
use App\Models\Emprestimo;
use App\Models\User;
use Carbon\Carbon;

class LivroSeeder extends Seeder
{
    public function run()
    {
        // Criar livros de exemplo
        $livros = [
            [
                'titulo' => 'O Senhor dos Anéis',
                'autor' => 'J.R.R. Tolkien',
                'categoria' => 'Fantasia',
                'ano_publicacao' => 1954,
                'descricao' => 'Uma épica saga de fantasia sobre a jornada para destruir um anel poderoso.',
                'isbn' => '9788533613379',
                'quantidade' => 5
            ],
            [
                'titulo' => 'Harry Potter e a Pedra Filosofal',
                'autor' => 'J.K. Rowling',
                'categoria' => 'Fantasia',
                'ano_publicacao' => 1997,
                'descricao' => 'A história de um jovem bruxo que descobre seu destino mágico.',
                'isbn' => '9788533613378',
                'quantidade' => 8
            ],
            [
                'titulo' => '1984',
                'autor' => 'George Orwell',
                'categoria' => 'Ficção Científica',
                'ano_publicacao' => 1949,
                'descricao' => 'Um romance distópico sobre vigilância e controle totalitário.',
                'isbn' => '9788533613377',
                'quantidade' => 3
            ],
            [
                'titulo' => 'O Pequeno Príncipe',
                'autor' => 'Antoine de Saint-Exupéry',
                'categoria' => 'Literatura Infantil',
                'ano_publicacao' => 1943,
                'descricao' => 'Uma história poética sobre amizade, amor e o sentido da vida.',
                'isbn' => '9788533613376',
                'quantidade' => 10
            ],
            [
                'titulo' => 'Dom Casmurro',
                'autor' => 'Machado de Assis',
                'categoria' => 'Literatura Brasileira',
                'ano_publicacao' => 1899,
                'descricao' => 'Um clássico da literatura brasileira sobre ciúme e traição.',
                'isbn' => '9788533613375',
                'quantidade' => 4
            ],
            [
                'titulo' => 'A Revolução dos Bichos',
                'autor' => 'George Orwell',
                'categoria' => 'Ficção Política',
                'ano_publicacao' => 1945,
                'descricao' => 'Uma sátira política sobre a Revolução Russa.',
                'isbn' => '9788533613374',
                'quantidade' => 6
            ],
            [
                'titulo' => 'O Hobbit',
                'autor' => 'J.R.R. Tolkien',
                'categoria' => 'Fantasia',
                'ano_publicacao' => 1937,
                'descricao' => 'A aventura de Bilbo Bolseiro em busca de um tesouro.',
                'isbn' => '9788533613373',
                'quantidade' => 7
            ],
            [
                'titulo' => 'Cem Anos de Solidão',
                'autor' => 'Gabriel García Márquez',
                'categoria' => 'Realismo Mágico',
                'ano_publicacao' => 1967,
                'descricao' => 'Uma obra-prima do realismo mágico latino-americano.',
                'isbn' => '9788533613372',
                'quantidade' => 3
            ],
            [
                'titulo' => 'O Guia do Mochileiro das Galáxias',
                'autor' => 'Douglas Adams',
                'categoria' => 'Ficção Científica',
                'ano_publicacao' => 1979,
                'descricao' => 'Uma comédia de ficção científica sobre a busca pelo sentido da vida.',
                'isbn' => '9788533613371',
                'quantidade' => 5
            ],
            [
                'titulo' => 'Grande Sertão: Veredas',
                'autor' => 'João Guimarães Rosa',
                'categoria' => 'Literatura Brasileira',
                'ano_publicacao' => 1956,
                'descricao' => 'Um dos maiores romances da literatura brasileira.',
                'isbn' => '9788533613370',
                'quantidade' => 2
            ]
        ];

        foreach ($livros as $livro) {
            Livro::create($livro);
        }

        // Criar alguns usuários se não existirem
        $users = User::all();
        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        // Criar empréstimos de exemplo para o mês atual
        $livrosIds = Livro::pluck('id')->toArray();
        $usersIds = $users->pluck('id')->toArray();

        // Criar empréstimos variados para simular popularidade
        $emprestimosPorLivro = [
            1 => 15, // O Senhor dos Anéis - mais popular
            2 => 12, // Harry Potter
            3 => 8,  // 1984
            4 => 10, // O Pequeno Príncipe
            5 => 6,  // Dom Casmurro
            6 => 9,  // A Revolução dos Bichos
            7 => 11, // O Hobbit
            8 => 4,  // Cem Anos de Solidão
            9 => 7,  // O Guia do Mochileiro
            10 => 3  // Grande Sertão
        ];

        foreach ($emprestimosPorLivro as $livroId => $quantidade) {
            for ($i = 0; $i < $quantidade; $i++) {
                $dataEmprestimo = Carbon::now()->subDays(rand(1, 30));
                
                Emprestimo::create([
                    'user_id' => $usersIds[array_rand($usersIds)],
                    'livro_id' => $livroId,
                    'data_emprestimo' => $dataEmprestimo->format('Y-m-d'),
                    'data_devolucao_prevista' => $dataEmprestimo->addDays(15)->format('Y-m-d'),
                    'status' => 'ativo',
                    'created_at' => $dataEmprestimo,
                    'updated_at' => $dataEmprestimo
                ]);
            }
        }
    }
} 