@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-chart p-4" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
                <div class="card-header border-0 bg-transparent mb-3">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2 class="card-title mb-0" style="font-weight:700; letter-spacing:1px; color: var(--turquesa);">
                                Gestão de <span style="color:var(--verde-logo);">Dados</span> ENKI
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-4 mb-md-0">
                            <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                                <h4 class="text-info mb-2" style="font-size: 1.25rem;">Livros</h4>
                                <h2 class="text-primary" style="font-size: 2rem;">{{ $livrosCount }}</h2>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                                <h4 class="text-info mb-2" style="font-size: 1.25rem;">Usuários</h4>
                                <h2 class="text-success" style="font-size: 2rem;">{{ $usuariosCount }}</h2>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                                <h4 class="text-info mb-2" style="font-size: 1.25rem;">Empréstimos Ativos</h4>
                                <h2 class="text-warning" style="font-size: 2rem;">{{ $emprestimosCount }}</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                                <h4 class="text-info mb-2" style="font-size: 1.25rem;">Atrasos</h4>
                                <h2 class="text-danger" style="font-size: 2rem;">{{ $atrasosCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Gráficos no padrão da tela de livros --}}
    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card card-chart p-4" style="background: rgba(35,57,93,0.85);">
                <div class="card-header border-0 bg-transparent">
                    <h4 class="card-title text-info"> Evolução dos empréstimos ao longo do ano</h4>
                </div>
                <div class="card-body">
                    <div class="chart-area bg-white rounded-4 shadow p-3">
                        <canvas id="chartEmprestimos"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-chart p-4" style="background: rgba(35,57,93,0.85);">
                <div class="card-header border-0 bg-transparent">
                    <h4 class="card-title text-info"> Volume de acessos dos usuários mensalmente</h4>
                </div>
                <div class="card-body">
                    <div class="chart-area bg-white rounded-4 shadow p-3">
                        <canvas id="chartAcessos"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-chart p-4" style="background: rgba(35,57,93,0.85);">
                <div class="card-header border-0 bg-transparent">
                    <h4 class="card-title text-info"> Acompanhamento de multas por atrasos</h4>
                </div>
                <div class="card-body">
                    <div class="chart-area bg-white rounded-4 shadow p-3">
                        <canvas id="chartMultas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabela de Categorias Populares --}}
    <div class="row mt-4">
        <div class="col-12">
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
            <div class="card" style="background: rgba(35,57,93,0.85);">
                <div class="card-header border-0 bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title text-info mb-0">📊 Categorias Mais Populares</h4>
                        </div>
                        <div class="col-auto">
                            <span class="badge badge-success">Dados Atualizados</span>
                        </div>
                    </div>
                    <p class="text-muted mb-0 mt-2">Ranking das categorias com maior volume de empréstimos</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table class="table tablesorter text-center mb-0">
                            <thead class="text-primary">
                                <tr>
                                    <th style="color: #23395d; font-weight: bold;">🏆 Posição</th>
                                    <th style="color: #23395d; font-weight: bold;">📚 Categoria</th>
                                    <th style="color: #23395d; font-weight: bold;">📖 Livros</th>
                                    <th style="color: #23395d; font-weight: bold;">📈 Empréstimos</th>
                                    <th style="color: #23395d; font-weight: bold;">📊 Popularidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Aqui ficam as linhas da tabela, como já estavam --}}
                                @foreach ($categoriasPopulares ?? [] as $i => $cat)
                                <tr>
                                    <td><span class="badge badge-warning" style="background-color: #FFD700; color: #23395d;">{{ $i+1 }}º</span></td>
                                    <td><strong>{{ $cat['nome'] }}</strong></td>
                                    <td><span class="text-primary font-weight-bold">{{ $cat['livros'] }}</span></td>
                                    <td><span class="text-success font-weight-bold">{{ $cat['emprestimos'] }}</span></td>
                                    <td>
                                        <div class="progress" style="height: 8px; background-color: rgba(35,57,93,0.1);">
                                            <div class="progress-bar" style="background: linear-gradient(90deg, var(--turquesa), var(--areia-deserto)); width: {{ $cat['percent'] ?? 0 }}%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Cores do ENKI
const ENKI_COLORS = {
    jato: '#333333',
    turquesa: '#48E5C2',
    salMarinho: '#FCFAF9',
    areiaDeserto: '#F3D3BD',
    cinzaDavy: '#5E5E5E'
};

const meses = {!! json_encode($meses ?? ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]) !!};
const dadosEmprestimos = @json($dadosEmprestimos ?? []);
const dadosAcessos = @json($dadosAcessos ?? []);
const dadosMultas = @json($dadosMultas ?? []);

function getGradient(ctx, color1, color2) {
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, color1);
    gradient.addColorStop(1, color2);
    return gradient;
}

document.addEventListener('DOMContentLoaded', function() {
    // Gráfico 1: Empréstimos Mensais
    const ctxEmp = document.getElementById('chartEmprestimos');
    if (ctxEmp) {
        const gradEmp = getGradient(ctxEmp.getContext('2d'), ENKI_COLORS.turquesa, ENKI_COLORS.areiaDeserto);
        const labelsEmp = (dadosEmprestimos && dadosEmprestimos.some(v => v > 0)) ? meses : ['Sem dados'];
        const dataEmp = (dadosEmprestimos && dadosEmprestimos.some(v => v > 0)) ? dadosEmprestimos : [0];
        new Chart(ctxEmp, {
            type: 'line',
            data: {
                labels: labelsEmp,
                datasets: [{
                    label: 'Empréstimos',
                    data: dataEmp,
                    borderColor: gradEmp,
                    backgroundColor: 'rgba(35,57,93,0.15)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: ENKI_COLORS.areiaDeserto,
                    pointBorderColor: ENKI_COLORS.turquesa,
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
                    x: { grid: { display: false }, ticks: { color: ENKI_COLORS.cinzaDavy, maxRotation: 45 } },
                    y: { beginAtZero: true, ticks: { color: ENKI_COLORS.cinzaDavy } }
                }
            }
        });
    }
    // Gráfico 2: Acessos Mensais
    const ctxAcs = document.getElementById('chartAcessos');
    if (ctxAcs) {
        const gradAcs = getGradient(ctxAcs.getContext('2d'), ENKI_COLORS.turquesa, ENKI_COLORS.turquesa);
        const labelsAcs = (dadosAcessos && dadosAcessos.some(v => v > 0)) ? meses : ['Sem dados'];
        const dataAcs = (dadosAcessos && dadosAcessos.some(v => v > 0)) ? dadosAcessos : [0];
        new Chart(ctxAcs, {
            type: 'line',
            data: {
                labels: labelsAcs,
                datasets: [{
                    label: 'Acessos',
                    data: dataAcs,
                    borderColor: gradAcs,
                    backgroundColor: 'rgba(35,57,93,0.15)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: ENKI_COLORS.areiaDeserto,
                    pointBorderColor: ENKI_COLORS.turquesa,
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
                    x: { grid: { display: false }, ticks: { color: ENKI_COLORS.cinzaDavy, maxRotation: 45 } },
                    y: { beginAtZero: true, ticks: { color: ENKI_COLORS.cinzaDavy } }
                }
            }
        });
    }
    // Gráfico 3: Multas Mensais
    const ctxMul = document.getElementById('chartMultas');
    if (ctxMul) {
        const gradMul = getGradient(ctxMul.getContext('2d'), ENKI_COLORS.turquesa, ENKI_COLORS.cinzaDavy);
        const labelsMul = (dadosMultas && dadosMultas.some(v => v > 0)) ? meses : ['Sem dados'];
        const dataMul = (dadosMultas && dadosMultas.some(v => v > 0)) ? dadosMultas : [0];
        new Chart(ctxMul, {
            type: 'line',
            data: {
                labels: labelsMul,
                datasets: [{
                    label: 'Multas',
                    data: dataMul,
                    borderColor: gradMul,
                    backgroundColor: 'rgba(35,57,93,0.15)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: ENKI_COLORS.areiaDeserto,
                    pointBorderColor: ENKI_COLORS.turquesa,
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
                    x: { grid: { display: false }, ticks: { color: ENKI_COLORS.cinzaDavy, maxRotation: 45 } },
                    y: { beginAtZero: true, ticks: { color: ENKI_COLORS.cinzaDavy } }
                }
            }
        });
    }
});
</script>
@endpush
