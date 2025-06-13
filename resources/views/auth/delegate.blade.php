@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('imagens/enki.jpg') }}" alt="Logo ENKI">
            </div>
        </div>
        
        <div class="auth-header">
            <h1>DELEGAÇÃO DE PODERES</h1>
            <p>Configure as permissões de acesso</p>
        </div>
        
        <div class="divider"></div>
        
        <div class="auth-body">
            <form method="POST" action="{{ route('delegation.delegate') }}">
                @csrf

                <div class="form-group">
                    <label for="email">E-mail do Delegado</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="permission_level">Nível de Permissão</label>
                    <select id="permission_level" name="permission_level" class="form-control" required>
                        <option value="read">Somente Leitura</option>
                        <option value="write">Leitura e Escrita</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="expires_at">Validade</label>
                    <input type="date" id="expires_at" name="expires_at" class="form-control" required>
                </div>
                
                <button type="submit" class="btn-auth">DELEGAR PODERES</button>
            </form>
        </div>
    </div>
</div>
@endsection