@if (Request::is('relatorios'))
<div class="p-10 text-white bg-black min-h-screen">
    <h2 class="text-3xl font-bold mb-6">📈 Relatórios</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-800 p-6 rounded-xl">
            <h3 class="text-lg font-semibold mb-2">Livros mais emprestados</h3>
            <ul class="list-disc list-inside">
                <li>Livro A (32x)</li>
                <li>Livro B (28x)</li>
            </ul>
        </div>
        <div class="bg-gray-800 p-6 rounded-xl">
            <h3 class="text-lg font-semibold mb-2">Usuários com mais empréstimos</h3>
            <ul class="list-decimal list-inside">
                <li>Maria (15 empréstimos)</li>
                <li>João (12 empréstimos)</li>
            </ul>
        </div>
    </div>
</div>
@endif
@endsection