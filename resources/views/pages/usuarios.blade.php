@extends('layouts.app', ['pageSlug' => 'usuarios'])

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card card-chart p-4" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
            <div class="card-header border-0 bg-transparent mb-3 d-flex justify-content-between align-items-center">
                <div class="row w-100">
                    <div class="col-sm-12 text-center">
                        <h2 class="card-title mb-0" style="font-weight:700; letter-spacing:1px;">Gestão de <span style="color:#19e6a7;">Usuários</span> ENKI</h2>
                    </div>
                </div>
                @if(auth()->user() && auth()->user()->isAdmin())
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#novoUsuarioModal">
                    Novo Usuário
                </button>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                            <h4 class="text-info mb-2" style="font-size: 1.25rem;">Total de Usuários</h4>
                            <h2 class="text-primary" style="font-size: 2rem;">{{ $totalUsuarios }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                            <h4 class="text-info mb-2" style="font-size: 1.25rem;">Usuários Ativos</h4>
                            <h2 class="text-success" style="font-size: 2rem;">{{ $usuariosAtivos }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                            <h4 class="text-info mb-2" style="font-size: 1.25rem;">Novos no Mês</h4>
                            <h2 class="text-warning" style="font-size: 2rem;">{{ $novosUsuariosMes }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-6 mb-4">
        <div class="card" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
            <div class="card-header border-0 bg-transparent">
                <h4 class="card-title text-info">📈 Usuários Registrados por Mês</h4>
            </div>
            <div class="card-body">
                <div class="chart-area bg-white rounded-4 shadow p-3">
                    <canvas id="graficoUsuariosMes" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
            <div class="card-header border-0 bg-transparent">
                <h4 class="card-title text-info">🔍 Análise de Acessos dos Usuários</h4>
            </div>
            <div class="card-body">
                <div class="chart-area bg-white rounded-4 shadow p-3">
                    <canvas id="graficoAcessosUsuarios" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 mb-4">
        <form method="GET" class="row g-2 mb-3 align-items-end">
            <div class="col-md-4">
                <label for="busca" class="form-label mb-1">Buscar</label>
                <input type="text" name="busca" id="busca" class="form-control" placeholder="Nome, email ou matrícula" value="{{ request('busca') }}">
            </div>
            <div class="col-md-3">
                <label for="perfil" class="form-label mb-1">Perfil</label>
                <select name="perfil" id="perfil" class="form-control">
                    <option value="">Todos</option>
                    <option value="admin" @if(request('perfil')=='admin') selected @endif>Admin</option>
                    <option value="bibliotecario" @if(request('perfil')=='bibliotecario') selected @endif>Bibliotecário</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label mb-1">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="ativo" @if(request('status')=='ativo') selected @endif>Ativo</option>
                    <option value="inativo" @if(request('status')=='inativo') selected @endif>Inativo</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
            <div class="card-header border-0 bg-transparent">
                <h4 class="card-title text-info">👥 Usuários Cadastrados</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="overflow-x:auto;">
                    <table class="table tablesorter text-center mb-0">
                        <thead class="text-primary">
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Perfil</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->nome }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @if(auth()->user() && auth()->user()->isAdmin())
                                    <form action="{{ route('usuarios.updatePerfil', $usuario) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="perfil" class="form-select form-select-sm d-inline w-auto @error('perfil') is-invalid @enderror" onchange="this.form.submit()">
                                            <option value="admin" {{ $usuario->perfil == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="bibliotecario" {{ $usuario->perfil == 'bibliotecario' ? 'selected' : '' }}>Bibliotecário</option>
                                        </select>
                                        @error('perfil')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    </form>
                                    @else
                                        {{ ucfirst($usuario->perfil) }}
                                    @endif
                                </td>
                                <td><span class="badge badge-{{ $usuario->status == 'ativo' ? 'success' : 'secondary' }}">{{ ucfirst($usuario->status) }}</span></td>
                                <td>
                                    @if(auth()->user() && auth()->user()->isAdmin() && auth()->id() !== $usuario->id)
                                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Novo Usuário -->
@if(auth()->user() && auth()->user()->isAdmin())
<div class="modal fade" id="novoUsuarioModal" tabindex="-1" aria-labelledby="novoUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="novoUsuarioModalLabel">Novo Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required autofocus minlength="3" maxlength="255">
                        @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required maxlength="255">
                        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="perfil" class="form-label">Perfil</label>
                        <select class="form-control @error('perfil') is-invalid @enderror" id="perfil" name="perfil" required>
                            <option value="admin" {{ old('perfil') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="bibliotecario" {{ old('perfil') == 'bibliotecario' ? 'selected' : '' }}>Bibliotecário</option>
                        </select>
                        @error('perfil')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required minlength="6">
                        @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control @error('matricula') is-invalid @enderror" id="matricula" name="matricula" value="{{ old('matricula') }}" required minlength="3" maxlength="255">
                        @error('matricula')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const meses = @json($meses);
const mediaUsuariosMes = @json($mediaUsuariosMes);
const ctxUsuariosMes = document.getElementById('graficoUsuariosMes').getContext('2d');
new Chart(ctxUsuariosMes, {
    type: 'bar',
    data: {
        labels: meses,
        datasets: [{
            label: 'Usuários',
            data: mediaUsuariosMes,
            backgroundColor: '#19e6a7',
            borderColor: '#009B8F',
            borderWidth: 2,
            borderRadius: 10,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#23395d', font: { weight: 'bold' } } },
            y: { beginAtZero: true, ticks: { color: '#23395d', font: { weight: 'bold' } }, grid: { color: 'rgba(0,155,143,0.1)' } }
        }
    }
});
const acessosLabels = @json($acessosLabels);
const acessosData = @json($acessosData);
const ctxAcessos = document.getElementById('graficoAcessosUsuarios').getContext('2d');
new Chart(ctxAcessos, {
    type: 'line',
    data: {
        labels: acessosLabels,
        datasets: [{
            label: 'Acessos',
            data: acessosData,
            borderColor: '#19e6a7',
            backgroundColor: 'rgba(35,57,93,0.15)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#19e6a7',
            pointBorderColor: '#23395d',
            pointRadius: 6,
            pointHoverRadius: 10,
            borderWidth: 4,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#23395d', maxRotation: 45 } },
            y: { beginAtZero: true, ticks: { color: '#23395d' } }
        }
    }
});
// Foco automático no primeiro campo inválido ao submeter
const form = document.querySelector('#novoUsuarioModal form');
if(form) {
    form.addEventListener('submit', function(e) {
        const firstInvalid = form.querySelector('.is-invalid');
        if(firstInvalid) {
            firstInvalid.focus();
        }
    });
}
</script>
@endpush