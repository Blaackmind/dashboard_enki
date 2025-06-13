@if (Request::is('usuarios'))
<div class="p-10 text-white bg-black min-h-screen">
    <h2 class="text-3xl text-[#009B8F] font-bold mb-6">👥 Usuários Cadastrados</h2>
    <table class="w-full text-left text-sm">
        <thead class="bg-[#009B8F] text-black">
            <tr><th class="p-2">Nome</th><th class="p-2">Email</th><th class="p-2">Perfil</th><th class="p-2">Status</th></tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            <!-- Loop de usuários -->
            <tr><td class="p-2">Maria Silva</td><td class="p-2">maria@enki.com</td><td class="p-2">Leitor</td><td class="p-2 text-green-400">Ativo</td></tr>
        </tbody>
    </table>
</div>
@endif