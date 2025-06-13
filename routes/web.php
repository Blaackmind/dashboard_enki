<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\Delegation\DelegationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmprestimoController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Login, Registro, Recuperar Senha, Verificação)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas de Registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Rotas de Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rotas de Recuperação de Senha
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Rotas de Verificação de Email
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rotas do Dashboard e Funcionalidades Principais
|--------------------------------------------------------------------------

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rotas temporárias
    Route::view('/menu', 'pages.menu')->name('menu');
    Route::view('/livros', 'pages.livros')->name('livros');
    Route::view('/usuarios', 'pages.usuarios')->name('usuarios');
    Route::view('/emprestimos', 'pages.emprestimos')->name('emprestimos');
    Route::view('/relatorios', 'pages.relatorios')->name('relatorios');
});
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('emprestimos', EmprestimoController::class);
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