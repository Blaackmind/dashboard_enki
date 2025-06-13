@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Gerenciamento de Empréstimos</h6>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#novoEmprestimoModal">
                        Novo Empréstimo
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if(session('success'))
                        <div class="alert alert-success mx-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuário</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Livro</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data Empréstimo</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Devolução Prevista</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emprestimos as $emprestimo)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $emprestimo->user->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $emprestimo->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $emprestimo->livro->titulo }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ date('d/m/Y', strtotime($emprestimo->data_emprestimo)) }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ date('d/m/Y', strtotime($emprestimo->data_devolucao_prevista)) }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-{{ $emprestimo->status == 'ativo' ? 'success' : ($emprestimo->status == 'atrasado' ? 'danger' : 'info') }}">
                                            {{ ucfirst($emprestimo->status) }}
                                        </span>
                                    </td>
                                    <td>
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
                        <select class="form-control" id="user_id" name="user_id" required>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="livro_id" class="form-label">Livro</label>
                        <select class="form-control" id="livro_id" name="livro_id" required>
                            @foreach(\App\Models\Livro::all() as $livro)
                                <option value="{{ $livro->id }}">{{ $livro->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="data_emprestimo" class="form-label">Data do Empréstimo</label>
                        <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" required value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label for="data_devolucao_prevista" class="form-label">Data Prevista para Devolução</label>
                        <input type="date" class="form-control" id="data_devolucao_prevista" name="data_devolucao_prevista" required value="{{ date('Y-m-d', strtotime('+7 days')) }}">
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
                        <input type="text" class="form-control" value="{{ $emprestimo->user->name }}" disabled>
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
@endsection 