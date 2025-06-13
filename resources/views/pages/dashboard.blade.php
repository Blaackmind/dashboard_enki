@if (Request::is('dashboard'))
<div class="bg-black min-h-screen text-white px-8 py-10">
    <h1 class="text-4xl font-bold text-[#4FA0D7] mb-10">📊 Painel de Controle</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-dashboard.card title="Livros" :value="$livrosCount" color="bg-[#4FA0D7]" />
        <x-dashboard.card title="Usuários" :value="$usuariosCount" color="bg-[#009B8F]" />
        <x-dashboard.card title="Empréstimos Ativos" :value="$emprestimosCount" color="bg-yellow-500" />
        <x-dashboard.card title="Atrasos" :value="$atrasosCount" color="bg-red-500" />
    </div>
    <div class="mt-12">
        <h2 class="text-2xl font-semibold mb-4">📚 Categorias Populares</h2>
        <div class="bg-white p-6 rounded-xl">
            <canvas id="graficoCategorias"></canvas>
        </div>
    </div>
</div>
@endif