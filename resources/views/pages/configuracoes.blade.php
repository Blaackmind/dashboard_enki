@extends('layouts.app')

@section('title', 'Configurações do Sistema')

@section('content')
<div class="config-bg p-4" style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-cogs me-2"></i>
                            Configurações do Sistema
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Navegação por abas -->
                        <ul class="nav nav-tabs" id="configTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="geral-tab" data-bs-toggle="tab" data-bs-target="#geral" type="button" role="tab">
                                    <i class="fas fa-sliders-h me-2"></i>Geral
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="emprestimos-tab" data-bs-toggle="tab" data-bs-target="#emprestimos" type="button" role="tab">
                                    <i class="fas fa-book me-2"></i>Empréstimos
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="multas-tab" data-bs-toggle="tab" data-bs-target="#multas" type="button" role="tab">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Multas
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="usuarios-tab" data-bs-toggle="tab" data-bs-target="#usuarios" type="button" role="tab">
                                    <i class="fas fa-users me-2"></i>Usuários
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="backup-tab" data-bs-toggle="tab" data-bs-target="#backup" type="button" role="tab">
                                    <i class="fas fa-database me-2"></i>Backup
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="logs-tab" data-bs-toggle="tab" data-bs-target="#logs" type="button" role="tab">
                                    <i class="fas fa-file-alt me-2"></i>Logs
                                </button>
                            </li>
                        </ul>

                        <!-- Conteúdo das abas -->
                        <div class="tab-content mt-4" id="configTabsContent">
                            <!-- Aba Geral -->
                            <div class="tab-pane fade show active" id="geral" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informações do Sistema</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nome da Biblioteca</label>
                                                    <input type="text" class="form-control" value="ENKI Biblioteca" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Versão do Sistema</label>
                                                    <input type="text" class="form-control" value="v1.0.0" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Última Atualização</label>
                                                    <input type="text" class="form-control" value="{{ date('d/m/Y H:i') }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status do Sistema</label>
                                                    <span class="badge bg-success">Online</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-bell me-2"></i>Notificações</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="notifEmail" checked>
                                                    <label class="form-check-label" for="notifEmail">
                                                        Notificações por E-mail
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="notifSistema" checked>
                                                    <label class="form-check-label" for="notifSistema">
                                                        Notificações do Sistema
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="notifAtrasos">
                                                    <label class="form-check-label" for="notifAtrasos">
                                                        Alertas de Atraso
                                                    </label>
                                                </div>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-2"></i>Salvar Configurações
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Aba Empréstimos -->
                            <div class="tab-pane fade" id="emprestimos" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Prazos de Empréstimo</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Prazo Padrão (dias)</label>
                                                    <input type="number" class="form-control" value="15" min="1" max="90">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Prazo para Alunos (dias)</label>
                                                    <input type="number" class="form-control" value="10" min="1" max="90">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Prazo para Professores (dias)</label>
                                                    <input type="number" class="form-control" value="30" min="1" max="90">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Renovações Permitidas</label>
                                                    <input type="number" class="form-control" value="2" min="0" max="5">
                                                </div>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-2"></i>Salvar Configurações
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-bookmark me-2"></i>Limites de Empréstimo</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Máximo de Livros por Usuário</label>
                                                    <input type="number" class="form-control" value="5" min="1" max="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Máximo para Alunos</label>
                                                    <input type="number" class="form-control" value="3" min="1" max="10">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Máximo para Professores</label>
                                                    <input type="number" class="form-control" value="8" min="1" max="15">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Máximo para Bibliotecários</label>
                                                    <input type="number" class="form-control" value="10" min="1" max="20">
                                                </div>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-2"></i>Salvar Configurações
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Aba Multas -->
                            <div class="tab-pane fade" id="multas" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Configuração de Multas</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Valor por Dia de Atraso (R$)</label>
                                                    <input type="number" class="form-control" value="2.50" step="0.01" min="0">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Dias de Tolerância</label>
                                                    <input type="number" class="form-control" value="3" min="0" max="7">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Multa Máxima (R$)</label>
                                                    <input type="number" class="form-control" value="50.00" step="0.01" min="0">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Desconto para Pagamento Antecipado (%)</label>
                                                    <input type="number" class="form-control" value="10" min="0" max="50">
                                                </div>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-2"></i>Salvar Configurações
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-ban me-2"></i>Restrições por Multa</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="bloquearMulta" checked>
                                                    <label class="form-check-label" for="bloquearMulta">
                                                        Bloquear Empréstimos com Multa Pendente
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="notifMulta" checked>
                                                    <label class="form-check-label" for="notifMulta">
                                                        Notificar Usuários sobre Multas
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="autoMulta">
                                                    <label class="form-check-label" for="autoMulta">
                                                        Aplicar Multas Automaticamente
                                                    </label>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Valor Mínimo para Bloqueio (R$)</label>
                                                    <input type="number" class="form-control" value="10.00" step="0.01" min="0">
                                                </div>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-2"></i>Salvar Configurações
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Aba Usuários -->
                            <div class="tab-pane fade" id="usuarios" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-user-plus me-2"></i>Cadastro de Usuários</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="autoAtivar" checked>
                                                    <label class="form-check-label" for="autoAtivar">
                                                        Ativar Usuários Automaticamente
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="validarEmail">
                                                    <label class="form-check-label" for="validarEmail">
                                                        Validar E-mail no Cadastro
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="matriculaObrigatoria" checked>
                                                    <label class="form-check-label" for="matriculaObrigatoria">
                                                        Matrícula Obrigatória
                                                    </label>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Perfil Padrão para Novos Usuários</label>
                                                    <select class="form-select">
                                                        <option value="leitor">Leitor</option>
                                                        <option value="bibliotecario">Bibliotecário</option>
                                                        <option value="admin">Administrador</option>
                                                    </select>
                                                </div>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-2"></i>Salvar Configurações
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-user-cog me-2"></i>Gerenciamento de Perfis</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Permissões por Perfil</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="adminEmprestimos" checked disabled>
                                                        <label class="form-check-label" for="adminEmprestimos">
                                                            Administradores: Gerenciar Empréstimos
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="adminUsuarios" checked disabled>
                                                        <label class="form-check-label" for="adminUsuarios">
                                                            Administradores: Gerenciar Usuários
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="biblioLivros" checked>
                                                        <label class="form-check-label" for="biblioLivros">
                                                            Bibliotecários: Gerenciar Livros
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="leitorReservas">
                                                        <label class="form-check-label" for="leitorReservas">
                                                            Leitores: Fazer Reservas
                                                        </label>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-2"></i>Salvar Configurações
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Aba Backup -->
                            <div class="tab-pane fade" id="backup" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-download me-2"></i>Backup Manual</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Último Backup</label>
                                                    <input type="text" class="form-control" value="15/01/2025 14:30" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tamanho do Backup</label>
                                                    <input type="text" class="form-control" value="2.5 MB" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <span class="badge bg-success">Concluído</span>
                                                </div>
                                                <button class="btn btn-success btn-sm me-2">
                                                    <i class="fas fa-download me-2"></i>Fazer Backup Agora
                                                </button>
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fas fa-download me-2"></i>Download Backup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Backup Automático</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="backupAuto" checked>
                                                    <label class="form-check-label" for="backupAuto">
                                                        Ativar Backup Automático
                                                    </label>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Frequência</label>
                                                    <select class="form-select">
                                                        <option value="daily">Diário</option>
                                                        <option value="weekly">Semanal</option>
                                                        <option value="monthly">Mensal</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Horário</label>
                                                    <input type="time" class="form-control" value="02:00">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Retenção (dias)</label>
                                                    <input type="number" class="form-control" value="30" min="1" max="365">
                                                </div>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-2"></i>Salvar Configurações
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Aba Logs -->
                            <div class="tab-pane fade" id="logs" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0"><i class="fas fa-file-alt me-2"></i>Logs do Sistema</h6>
                                                <div>
                                                    <button class="btn btn-sm btn-outline-secondary me-2">
                                                        <i class="fas fa-filter me-1"></i>Filtrar
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-download me-1"></i>Exportar
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Data/Hora</th>
                                                                <th>Usuário</th>
                                                                <th>Ação</th>
                                                                <th>Detalhes</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>15/01/2025 15:30</td>
                                                                <td>admin@enki.com</td>
                                                                <td>Login</td>
                                                                <td>Login realizado com sucesso</td>
                                                                <td><span class="badge bg-success">Sucesso</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>15/01/2025 15:25</td>
                                                                <td>joao@email.com</td>
                                                                <td>Empréstimo</td>
                                                                <td>Livro "Dom Casmurro" emprestado</td>
                                                                <td><span class="badge bg-success">Sucesso</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>15/01/2025 15:20</td>
                                                                <td>maria@email.com</td>
                                                                <td>Devolução</td>
                                                                <td>Livro "O Cortiço" devolvido</td>
                                                                <td><span class="badge bg-success">Sucesso</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>15/01/2025 15:15</td>
                                                                <td>admin@enki.com</td>
                                                                <td>Configuração</td>
                                                                <td>Alterada configuração de multas</td>
                                                                <td><span class="badge bg-warning">Alteração</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>15/01/2025 15:10</td>
                                                                <td>pedro@email.com</td>
                                                                <td>Login</td>
                                                                <td>Tentativa de login falhou</td>
                                                                <td><span class="badge bg-danger">Erro</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <nav aria-label="Navegação de logs">
                                                    <ul class="pagination pagination-sm justify-content-center">
                                                        <li class="page-item disabled">
                                                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                                                        </li>
                                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#">Próximo</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.nav-tabs .nav-link {
    color: #495057;
    border: none;
    border-bottom: 2px solid transparent;
    padding: 0.75rem 1rem;
    font-weight: 500;
}

.nav-tabs .nav-link:hover {
    border-color: transparent;
    color: #007bff;
}

.nav-tabs .nav-link.active {
    color: #007bff;
    background-color: transparent;
    border-bottom: 2px solid #007bff;
}

.card {
    border-radius: 0.5rem;
}

.card-header {
    border-bottom: 1px solid #e9ecef;
    background-color: #f8f9fa;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
}

.btn-success {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    border: none;
}

.btn-info {
    background: linear-gradient(135deg, #17a2b8, #117a8b);
    border: none;
}

/* Botões com fundo claro devem ter texto preto */
.btn-light,
.btn-outline-secondary,
.btn-outline-primary,
.btn-outline-info,
.btn-outline-success,
.btn-outline-warning,
.btn-outline-danger {
    color: #222 !important;
}

/* Botões customizados com background muito claro */
.btn,
button.btn {
    /* Se o background for muito claro, força o texto preto */
    color: #222;
}

/* Exceção para btn-primary, btn-success, btn-info, etc, que já têm contraste */
.btn-primary,
.btn-success,
.btn-info,
.btn-warning,
.btn-danger {
    color: #fff;
}

/* Fundo gradiente para a página de configurações (apenas no conteúdo principal) */
.config-bg {
    background: linear-gradient(135deg, #0f2027 0%, #2c5364 40%, #11998e 70%, #f7b42c 100%, #000 120%);
    /* azul escuro, verde, amarelo, preto */
}

.container-fluid, .card {
    z-index: 1;
    position: relative;
}

.card {
    background: rgba(30, 40, 50, 0.92); /* cinza escuro translúcido */
    color: #fff;
    border: none;
}

.card-header, .card-body, .form-control, .form-select {
    background: transparent !important;
    color: #fff !important;
}

.form-control::placeholder, .form-select option {
    color: #e0e0e0 !important;
}

/* Ajuste para botões claros dentro do card escuro */
.btn-light, .btn-outline-secondary, .btn-outline-primary, .btn-outline-info, .btn-outline-success, .btn-outline-warning, .btn-outline-danger {
    color: #222 !important;
    background: #fff !important;
    border: none;
}
</style>
@endsection