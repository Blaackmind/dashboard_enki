@if (Request::is('menu'))
<div class="min-h-screen bg-gradient-to-b from-[#48E5C2] to-[#F3D3BD] text-[#333333] p-10">
    <h1 class="text-4xl font-bold text-[#48E5C2] mb-10">🏛️ Menu Principal</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ([
            ['title' => 'Dashboard', 'url' => '/dashboard', 'color' => '#48E5C2'],
            ['title' => 'Livros', 'url' => '/livros', 'color' => '#F3D3BD'],
            ['title' => 'Usuários', 'url' => '/usuarios', 'color' => '#48E5C2'],
            ['title' => 'Empréstimos', 'url' => '/emprestimos', 'color' => '#F3D3BD'],
            ['title' => 'Relatórios', 'url' => '/relatorios', 'color' => '#48E5C2']
        ] as $item)
            <a href="{{ $item['url'] }}" class="rounded-xl p-6 shadow-xl font-semibold text-xl text-center hover:scale-105 transition" style="background: linear-gradient(90deg, {{ $item['color'] }} 0%, #F3D3BD 100%); color: #333333;">
                {{ $item['title'] }}
            </a>
        @endforeach
    </div>
</div>
@endif