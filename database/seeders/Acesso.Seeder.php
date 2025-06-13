<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acesso;

class AcessoSeeder extends Seeder
{
    public function run(): void
    {
        Acesso::factory()->count(50)->create(); // Gera 50 acessos fictícios
    }
}
