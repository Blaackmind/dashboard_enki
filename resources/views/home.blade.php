@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card p-5 shadow-lg" style="max-width: 500px; width: 100%; background:rgba(35,57,93,0.85);">
        <img src="{{ asset('imagens/logo2.png') }}" alt="Logo ENKI" class="logo-home">
        <h1 class="display-4 mb-3 mt-2 text-center">Bem-vindo ao <span style="color:#fafafa;">ENKI</span></h1>
        <p class="lead text-center mb-4">Acesse o menu lateral para navegar pelo sistema e visualizar estatísticas no dashboard.</p>
        <div class="d-flex justify-content-center">
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 py-2">Ir para o Dashboard</a>
        </div>
    </div>
</div>
@endsection 