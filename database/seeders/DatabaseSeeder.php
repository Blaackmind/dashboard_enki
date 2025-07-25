<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // \App\Models\User::factory(10)->create();

        \App\Models\User::firstOrCreate([
            'matricula' => 'admin00',
        ], [
            'nome' => 'Administrador',
            'email' => 'admin@enki.com',
            'perfil' => 'admin',
            'password' => bcrypt('707ama505@'),
            'status' => 'ativo',
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Executar o seeder de livros
        $this->call([
            LivroSeeder::class,
        ]);
    }
}
