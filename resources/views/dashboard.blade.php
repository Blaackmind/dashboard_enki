@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-chart p-4" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
                <div class="card-header border-0 bg-transparent mb-3">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2 class="card-title mb-0" style="font-weight:700; letter-spacing:1px;">Painel de <span style="color:#19e6a7;">Estatísticas</span> ENKI</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="chart-area bg-white rounded-4 shadow p-3">
                                <canvas id="chartEmprestimos"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="chart-area bg-white rounded-4 shadow p-3">
                                <canvas id="chartAcessos"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="chart-area bg-white rounded-4 shadow p-3">
                                <canvas id="chartMultas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
                <div class="card-header border-0 bg-transparent">
                    <h4 class="card-title text-info">Categorias Populares</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter text-center">
                            <thead class="text-primary">
                                <tr>
                                    <th>Categoria</th>
                                    <th>Livros</th>
                                    <th>Empréstimos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Ficção Científica</td><td>120</td><td>380</td></tr>
                                <tr><td>Romance</td><td>90</td><td>290</td></tr>
                                <tr><td>Biografias</td><td>50</td><td>170</td></tr>
                                <tr><td>Tecnologia</td><td>60</td><td>155</td></tr>
                                <tr><td>História</td><td>30</td><td>130</td></tr>
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
// Gradiente para os gráficos
function getGradient(ctx, color1, color2) {
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, color1);
    gradient.addColorStop(1, color2);
    return gradient;
}

const meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
const dadosEmprestimos = [12, 19, 13, 15, 22, 30, 25, 20, 18, 24, 28, 32];
const dadosAcessos = [100, 120, 90, 140, 130, 160, 170, 150, 145, 180, 200, 210];
const dadosMultas = [2, 3, 1, 4, 2, 5, 3, 2, 4, 6, 5, 7];

// Empréstimos (linha com gradiente azul escuro)
const ctxEmp = document.getElementById('chartEmprestimos').getContext('2d');
const gradEmp = getGradient(ctxEmp, '#23395d', '#19e6a7');
new Chart(ctxEmp, {
    type: 'line',
    data: {
        labels: meses,
        datasets: [{
            label: 'Empréstimos',
            data: dadosEmprestimos,
            borderColor: gradEmp,
            backgroundColor: 'rgba(35,57,93,0.15)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#23395d',
            pointBorderColor: '#19e6a7',
            pointRadius: 5,
            pointHoverRadius: 8,
            borderWidth: 4,
            shadowOffsetX: 0,
            shadowOffsetY: 4,
            shadowBlur: 10,
            shadowColor: '#23395d55',
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#23395d' } },
            y: { beginAtZero: true, ticks: { color: '#23395d' } }
        }
    }
});

// Acessos (barra com gradiente verde)
const ctxAcs = document.getElementById('chartAcessos').getContext('2d');
const gradAcs = getGradient(ctxAcs, '#19e6a7', '#23395d');
new Chart(ctxAcs, {
    type: 'bar',
    data: {
        labels: meses,
        datasets: [{
            label: 'Acessos',
            data: dadosAcessos,
            backgroundColor: gradAcs,
            borderColor: '#19e6a7',
            borderWidth: 2,
            borderRadius: 12,
            hoverBackgroundColor: '#11998e',
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#23395d' } },
            y: { beginAtZero: true, ticks: { color: '#23395d' } }
        }
    }
});

// Multas (linha com gradiente verde)
const ctxMul = document.getElementById('chartMultas').getContext('2d');
const gradMul = getGradient(ctxMul, '#19e6a7', '#23395d');
new Chart(ctxMul, {
    type: 'line',
    data: {
        labels: meses,
        datasets: [{
            label: 'Multas',
            data: dadosMultas,
            borderColor: gradMul,
            backgroundColor: 'rgba(25,230,167,0.15)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#19e6a7',
            pointBorderColor: '#23395d',
            pointRadius: 5,
            pointHoverRadius: 8,
            borderWidth: 4,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#23395d' } },
            y: { beginAtZero: true, ticks: { color: '#23395d' } }
        }
    }
});
</script>
@endpush
