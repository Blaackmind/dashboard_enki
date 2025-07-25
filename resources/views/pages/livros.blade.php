@extends('layouts.app', ['pageSlug' => 'livros'])

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-chart p-4" style="background: rgba(35,57,93,0.85);">
                <div class="card-header border-0 bg-transparent mb-3">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2 class="card-title mb-0" style="font-weight:700; letter-spacing:1px;">Gestão de <span style="color:#19e6a7;">Livros</span> ENKI</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-4 mb-md-0">
                            <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                                <h4 class="text-info mb-2" style="font-size: 1.25rem;">Total de Livros</h4>
                                <h2 class="text-primary" style="font-size: 2rem;">{{ $totalLivros }}</h2>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                                <h4 class="text-info mb-2" style="font-size: 1.25rem;">Livros Disponíveis</h4>
                                <h2 class="text-success" style="font-size: 2rem;">{{ $livrosDisponiveis }}</h2>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                                <h4 class="text-info mb-2" style="font-size: 1.25rem;">Empréstimos do Mês</h4>
                                <h2 class="text-warning" style="font-size: 2rem;">{{ $totalEmprestimosMes }}</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                                <h4 class="text-info mb-2" style="font-size: 1.25rem;">Categorias</h4>
                                <h2 class="text-danger" style="font-size: 2rem;">{{ count($estatisticasCategoria) }}</h2>
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
                    <h4 class="card-title text-info">📊 Livros Mais Populares (Mês Atual)</h4>
                </div>
                <div class="card-body">
                    <div class="chart-area bg-white rounded-4 shadow p-3">
                        <canvas id="graficoLivrosPopulares" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
                <div class="card-header border-0 bg-transparent">
                    <h4 class="card-title text-info">📈 Empréstimos por Categoria</h4>
                </div>
                <div class="card-body">
                    <div id="mensagemCategorias" class="text-center text-muted" style="display:none;">Nenhum dado para exibir.</div>
                    <div class="chart-area bg-white rounded-4 shadow p-3">
                        <canvas id="graficoCategorias" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
                <div class="card-header border-0 bg-transparent">
                    <h4 class="card-title text-info">📅 Empréstimos por Mês ({{ date('Y') }})</h4>
                </div>
                <div class="card-body">
                    <div id="mensagemMensal" class="text-center text-muted" style="display:none;">Nenhum dado para exibir.</div>
                    <div class="chart-area bg-white rounded-4 shadow p-3">
                        <canvas id="graficoMensal" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            <div class="card" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
                <div class="card-header border-0 bg-transparent">
                    <h4 class="card-title text-info">🏆 Top 10 Livros Mais Populares</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table class="table tablesorter text-center mb-0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Posição</th>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Categoria</th>
                                    <th>Descrição</th>
                                    <th>Empréstimos</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($livrosPopulares as $index => $livro)
                                <tr>
                                    <td>
                                        @if($index < 3)
                                            <span class="text-2xl">
                                                @if($index == 0)🥇
                                                @elseif($index == 1)🥈
                                                @elseif($index == 2)🥉
                                                @endif
                                            </span>
                                        @else
                                            <span class="badge badge-info">#{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $livro->titulo }}</strong><br>
                                        <small class="text-muted">{{ $livro->ano_publicacao }}</small>
                                    </td>
                                    <td>{{ $livro->autor }}</td>
                                    <td><span class="badge badge-primary">{{ $livro->categoria }}</span></td>
                                    <td>
                                        <small class="text-muted">
                                            {{ Str::limit($livro->descricao ?? 'Sem descrição disponível', 50) }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="text-info font-weight-bold">{{ $livro->total_emprestimos }}</span><br>
                                        <small class="text-muted">empréstimos</small>
                                    </td>
                                    <td><span class="badge badge-success">Disponível</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        Nenhum livro encontrado com empréstimos neste mês.
                                    </td>
                                </tr>
                                @endforelse
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
function getGradient(ctx, color1, color2) {
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, color1);
    gradient.addColorStop(1, color2);
    return gradient;
}

document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de Livros Mais Populares
    const ctxLivrosPopulares = document.getElementById('graficoLivrosPopulares').getContext('2d');
    const gradLivros = getGradient(ctxLivrosPopulares, '#23395d', '#19e6a7');
    const livrosLabels = @json($livrosPopulares->pluck('titulo')->take(8)->toArray());
    const livrosData = @json($livrosPopulares->pluck('total_emprestimos')->take(8)->toArray());
    new Chart(ctxLivrosPopulares, {
        type: 'line',
        data: {
            labels: livrosLabels.length ? livrosLabels : ['Sem dados'],
            datasets: [{
                label: 'Empréstimos no Mês',
                data: livrosData.length ? livrosData : [0],
                borderColor: gradLivros,
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

    // Gráfico de Categorias
    const ctxCategorias = document.getElementById('graficoCategorias').getContext('2d');
    const gradCategorias = getGradient(ctxCategorias, '#23395d', '#4FA0D7');
    const catLabels = @json($dadosGraficoCategoria['labels']);
    const catData = @json($dadosGraficoCategoria['data']);
    new Chart(ctxCategorias, {
        type: 'line',
        data: {
            labels: catLabels.length ? catLabels : ['Sem dados'],
            datasets: [{
                label: 'Empréstimos por Categoria',
                data: catData.length ? catData : [0],
                borderColor: gradCategorias,
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

    // Gráfico Mensal
    const ctxMensal = document.getElementById('graficoMensal').getContext('2d');
    const gradMensal = getGradient(ctxMensal, '#23395d', '#19e6a7');
    const mensalLabels = @json($dadosGraficoMensal['labels']);
    const mensalData = @json($dadosGraficoMensal['data']);
    new Chart(ctxMensal, {
        type: 'line',
        data: {
            labels: mensalLabels.length ? mensalLabels : ['Sem dados'],
            datasets: [{
                label: 'Empréstimos por Mês',
                data: mensalData.length ? mensalData : [0],
                borderColor: gradMensal,
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

    // Controle de mensagens para gráficos
    const mensagemLivrosPopulares = document.getElementById('mensagemLivrosPopulares');
    if (!livrosData.length || livrosData.every(v => v === 0)) {
        mensagemLivrosPopulares.style.display = 'block';
    }

    const mensagemCategorias = document.getElementById('mensagemCategorias');
    if (!catData.length || catData.every(v => v === 0)) {
        mensagemCategorias.style.display = 'block';
    }

    const mensagemMensal = document.getElementById('mensagemMensal');
    if (!mensalData.length || mensalData.every(v => v === 0)) {
        mensagemMensal.style.display = 'block';
    }
});
</script>
@endpush