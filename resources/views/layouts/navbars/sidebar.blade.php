<style>
@media (max-width: 900px) {
    .sidebar {
        position: fixed;
        left: -220px;
        top: 0;
        width: 220px;
        height: 100vh;
        background: #2a4a6a;
        z-index: 1050;
        transition: left 0.3s;
        box-shadow: 2px 0 8px #0002;
    }
    .sidebar.active {
        left: 0;
    }
    .sidebar-toggle {
        display: block;
        position: fixed;
        top: 16px;
        left: 16px;
        z-index: 1100;
        background: #2a4a6a;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 1.2rem;
        cursor: pointer;
    }
}
@media (min-width: 901px) {
    .sidebar-toggle {
        display: none;
    }
}
</style>
<button class="sidebar-toggle" onclick="document.querySelector('.sidebar').classList.toggle('active')">☰</button>
<aside class="sidebar">
    <div class="p-3">
        <h2 class="fw-bold mb-4">Menu</h2>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="/dashboard">Painel</a></li>
            <li class="nav-item"><a class="nav-link" href="/livros">Livros</a></li>
            @if(auth()->user() && auth()->user()->isAdmin())
                <li class="nav-item"><a class="nav-link" href="/usuarios">Usuários</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/perfil">Meu Perfil</a></li>
            @endif
            <li class="nav-item"><a class="nav-link" href="/emprestimos">Empréstimos</a></li>
            @if(auth()->user() && auth()->user()->isAdmin())
                <li class="nav-item"><a class="nav-link" href="/configuracoes">Configurações</a></li>
            @endif
        </ul>
    </div>
</aside>
<script>
// Fechar sidebar ao clicar fora em mobile
window.addEventListener('click', function(e) {
    const sidebar = document.querySelector('.sidebar');
    const toggle = document.querySelector('.sidebar-toggle');
    if (window.innerWidth <= 900 && sidebar.classList.contains('active')) {
        if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    }
});
</script>
