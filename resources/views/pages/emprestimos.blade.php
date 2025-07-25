@extends('layouts.app', ['pageSlug' => 'emprestimos'])

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card card-chart p-4" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
            <div class="card-header border-0 bg-transparent mb-3">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2 class="card-title mb-0" style="font-weight:700; letter-spacing:1px;">Gestão de <span style="color:#19e6a7;">Empréstimos</span> ENKI</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                            <h4 class="text-info mb-2" style="font-size: 1.25rem;">Total de Empréstimos</h4>
                            <h2 class="text-primary" style="font-size: 2rem;">{{ $totalEmprestimos }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                            <h4 class="text-info mb-2" style="font-size: 1.25rem;">Ativos</h4>
                            <h2 class="text-success" style="font-size: 2rem;">{{ $emprestimosAtivos }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-area bg-white rounded-4 shadow p-3 text-center">
                            <h4 class="text-info mb-2" style="font-size: 1.25rem;">Atrasados</h4>
                            <h2 class="text-danger" style="font-size: 2rem;">{{ $emprestimosAtrasados }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 mb-4">
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
            <div class="card-header border-0 bg-transparent d-flex justify-content-between align-items-center">
                <h4 class="card-title text-info">📚 Lista de Empréstimos</h4>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#novoEmprestimoModal">
                    Novo Empréstimo
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="overflow-x:auto;">
                    <table class="table tablesorter text-center mb-0">
                        <thead class="text-primary">
                            <tr>
                                <th>Usuário</th>
                                <th>Livro</th>
                                <th>Data Empréstimo</th>
                                <th>Devolução Prevista</th>
                                <th>Status</th>
                                <th>Multa</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emprestimos as $emprestimo)
                            <tr>
                                <td>{{ $emprestimo->user->nome }}</td>
                                <td>{{ $emprestimo->livro->titulo }}</td>
                                <td>{{ date('d/m/Y', strtotime($emprestimo->data_emprestimo)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($emprestimo->data_devolucao_prevista)) }}</td>
                                <td><span class="badge badge-{{ $emprestimo->status == 'ativo' ? 'success' : ($emprestimo->status == 'atrasado' ? 'danger' : 'info') }}">{{ ucfirst($emprestimo->status) }}</span></td>
                                <td>
                                    @if($emprestimo->multa)
                                        <span class="text-danger">R$ {{ number_format($emprestimo->multa->valor, 2, ',', '.') }}</span>
                                        @if(!$emprestimo->multa->paga)
                                            <span class="badge bg-warning">Pendente</span>
                                        @else
                                            <span class="badge bg-success">Paga</span>
                                        @endif
                                    @else
                                        <span class="text-success">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($emprestimo->status == 'ativo')
                                        <form action="{{ route('emprestimos.devolver', $emprestimo) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Confirmar devolução?')">Devolver</button>
                                        </form>
                                    @endif
                                    <button class="btn btn-link text-secondary mb-0" data-bs-toggle="modal" data-bs-target="#editarEmprestimoModal{{ $emprestimo->id }}">
                                        <i class="fa fa-edit text-xs"></i>
                                    </button>
                                    <form action="{{ route('emprestimos.destroy', $emprestimo) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger text-gradient mb-0" onclick="return confirm('Tem certeza que deseja excluir este empréstimo?')">
                                            <i class="fa fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-3 py-3">
                    {{ $emprestimos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Novo Empréstimo -->
<div class="modal fade" id="novoEmprestimoModal" tabindex="-1" aria-labelledby="novoEmprestimoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="novoEmprestimoModalLabel">Novo Empréstimo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('emprestimos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuário</label>
                        <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required autofocus>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="livro_id" class="form-label">Livro</label>
                        <select class="form-control @error('livro_id') is-invalid @enderror" id="livro_id" name="livro_id" required>
                            @foreach(\App\Models\Livro::all() as $livro)
                                <option value="{{ $livro->id }}">{{ $livro->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="data_emprestimo" class="form-label">Data do Empréstimo</label>
                        <input type="date" class="form-control @error('data_emprestimo') is-invalid @enderror" id="data_emprestimo" name="data_emprestimo" required value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label for="data_devolucao_prevista" class="form-label">Data Prevista para Devolução</label>
                        <input type="date" class="form-control @error('data_devolucao_prevista') is-invalid @enderror" id="data_devolucao_prevista" name="data_devolucao_prevista" required value="{{ date('Y-m-d', strtotime('+7 days')) }}">
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
<!-- Modais de Edição -->
@foreach($emprestimos as $emprestimo)
<div class="modal fade" id="editarEmprestimoModal{{ $emprestimo->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Empréstimo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('emprestimos.update', $emprestimo) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Usuário</label>
                        <input type="text" class="form-control" value="{{ $emprestimo->user->nome }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Livro</label>
                        <input type="text" class="form-control" value="{{ $emprestimo->livro->titulo }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="data_devolucao_prevista{{ $emprestimo->id }}" class="form-label">Data Prevista para Devolução</label>
                        <input type="date" class="form-control" id="data_devolucao_prevista{{ $emprestimo->id }}" name="data_devolucao_prevista" value="{{ $emprestimo->data_devolucao_prevista }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status{{ $emprestimo->id }}" class="form-label">Status</label>
                        <select class="form-control" id="status{{ $emprestimo->id }}" name="status" required>
                            <option value="ativo" {{ $emprestimo->status == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="devolvido" {{ $emprestimo->status == 'devolvido' ? 'selected' : '' }}>Devolvido</option>
                            <option value="atrasado" {{ $emprestimo->status == 'atrasado' ? 'selected' : '' }}>Atrasado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
{{-- Histórico de transações de multas do usuário --}}
<div class="row mt-4">
    <div class="col-12 mb-4">
        <div class="card" style="background: rgba(35,57,93,0.85); border-radius: 24px;">
            <div class="card-header border-0 bg-transparent">
                <h4 class="card-title text-info">💸 Histórico de Transações de Multas</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter text-center mb-0">
                        <thead class="text-primary">
                            <tr>
                                <th>Livro</th>
                                <th>Valor da Multa</th>
                                <th>Data da Multa</th>
                                <th>Dias de Atraso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historicoMultas as $multa)
                            <tr>
                                <td>{{ $multa->emprestimo->livro->titulo ?? '-' }}</td>
                                <td class="text-danger">R$ {{ number_format($multa->valor, 2, ',', '.') }}</td>
                                <td>{{ $multa->created_at ? $multa->created_at->format('d/m/Y') : '-' }}</td>
                                <td>
                                    @php
                                        $dias = 0;
                                        if ($multa->emprestimo && $multa->emprestimo->data_devolucao_prevista) {
                                            $dias = \Carbon\Carbon::parse($multa->emprestimo->data_devolucao_prevista)->diffInDays($multa->created_at, false);
                                        }
                                    @endphp
                                    {{ $dias > 0 ? $dias : '-' }}
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
<script>
// Foco automático no primeiro campo inválido ao submeter
const formEmp = document.querySelector('#novoEmprestimoModal form');
if(formEmp) {
    formEmp.addEventListener('submit', function(e) {
        const firstInvalid = formEmp.querySelector('.is-invalid');
        if(firstInvalid) {
            firstInvalid.focus();
        }
    });
}
</script>
@endpush 