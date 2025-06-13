@if (Request::is('menu'))
<div class="min-h-screen bg-gradient-to-b from-black via-[#1a1a1a] to-[#4FA0D7] text-white p-10">
    <h1 class="text-4xl font-bold text-[#4FA0D7] mb-10">🏛️ Menu Principal</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ([
            ['title' => 'Dashboard', 'url' => '/dashboard', 'color' => '#4FA0D7'],
            ['title' => 'Livros', 'url' => '/livros', 'color' => '#009B8F'],
            ['title' => 'Usuários', 'url' => '/usuarios', 'color' => '#FFD700'],
            ['title' => 'Empréstimos', 'url' => '/emprestimos', 'color' => '#FF6347'],
            ['title' => 'Relatórios', 'url' => '/relatorios', 'color' => '#ffffff']
        ] as $item)
            <a href="{{ $item['url'] }}" class="rounded-xl p-6 shadow-xl text-black font-semibold text-xl text-center hover:scale-105 transition" style="background-color: {{ $item['color'] }}">
                {{ $item['title'] }}
            </a>
        @endforeach
    </div>
</div>
@endif