<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\UserController;

// Rotas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    // Painel geral: ambos podem acessar
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas exclusivas do ADMIN
    Route::middleware('admin')->group(function () {
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
        Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
        Route::put('/usuarios/{usuario}/perfil', [UserController::class, 'updatePerfil'])->name('usuarios.updatePerfil');
        Route::get('/admin/perfil', [UserController::class, 'editAdmin'])->name('admin.perfil');
        Route::post('/admin/perfil', [UserController::class, 'updateAdmin'])->name('admin.perfil.update');
        Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');

        // Configurações e backups
        Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])->name('configuracoes');
        Route::post('/configuracoes/geral', [ConfiguracaoController::class, 'salvarConfiguracoes'])->name('configuracoes.geral');
        Route::post('/configuracoes/notificacoes', [ConfiguracaoController::class, 'salvarNotificacoes'])->name('configuracoes.notificacoes');
        Route::post('/configuracoes/usuarios', [ConfiguracaoController::class, 'salvarUsuarios'])->name('configuracoes.usuarios');
        Route::post('/configuracoes/backup', [ConfiguracaoController::class, 'salvarBackup'])->name('configuracoes.backup');
        Route::post('/configuracoes/backup/fazer', [ConfiguracaoController::class, 'fazerBackup'])->name('configuracoes.backup.fazer');
        Route::get('/configuracoes/backup/download', [ConfiguracaoController::class, 'downloadBackup'])->name('configuracoes.backup.download');
        Route::get('/configuracoes/logs/exportar', [ConfiguracaoController::class, 'exportarLogs'])->name('configuracoes.logs.exportar');
    });

    // Rotas exclusivas do BIBLIOTECÁRIO
    Route::middleware('bibliotecario')->group(function () {
        // Livros e empréstimos
        Route::get('/livros', [LivroController::class, 'index'])->name('livros');
        Route::get('/emprestimos', [EmprestimoController::class, 'index'])->name('emprestimos');
        Route::post('/emprestimos/{emprestimo}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');
        Route::post('/emprestimos', [EmprestimoController::class, 'store'])->name('emprestimos.store');
        // Outras rotas de bibliotecário podem ser adicionadas aqui
    });

    // Rotas de Livros e Empréstimos: admin OU bibliotecário
    Route::middleware('admin_or_bibliotecario')->group(function () {
        Route::get('/livros', [LivroController::class, 'index'])->name('livros');
        Route::get('/emprestimos', [EmprestimoController::class, 'index'])->name('emprestimos');
        Route::post('/emprestimos/{emprestimo}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');
        Route::post('/emprestimos', [EmprestimoController::class, 'store'])->name('emprestimos.store');
    });
});

/*
|--------------------------------------------------------------------------
| Rotas de Delegação de Poderes (Versão para testes)
|--------------------------------------------------------------------------
*/
// Rotas temporárias sem autenticação para testes
Route::prefix('delegation')->group(function () {
    Route::get('/', [DelegationController::class, 'showDelegationForm'])
        ->name('delegation.form');
        //->middleware('auth'); // Removido para testes

    Route::post('/delegate', [DelegationController::class, 'delegate'])
        ->name('delegation.delegate');
        //->middleware('auth'); // Removido para testes

    // Rota de teste para verificar autenticação
    Route::get('/test-auth', function () {
        return response()->json([
            'isAuthenticated' => auth()->check(),
            'user' => auth()->check() ? auth()->user()->only(['id', 'name', 'email']) : null
        ]);
    });
});

/*
|--------------------------------------------------------------------------
| Rotas de Debug/Teste (Remover em produção)
|--------------------------------------------------------------------------
*/
if (env('APP_DEBUG')) {
    Route::get('/debug-session', function() {
        return response()->json([
            'session' => session()->all(),
            'auth' => auth()->check() ? auth()->user() : null,
            'cookie' => request()->cookie()
        ]);
    });

    Route::get('/debug-middleware', function() {
        return response()->json([
            'middleware' => request()->route()->gatherMiddleware()
        ]);
    });
}

/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return redirect()->route('dashboard');
});