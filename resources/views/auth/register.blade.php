<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - ENKI</title>
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #48E5C2 0%, #F3D3BD 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .auth-container {
            width: 100%;
            max-width: 540px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: rgba(35,57,93,0.90);
            border-radius: 28px;
            box-shadow: 0 8px 32px 0 rgba(35,57,93,0.25);
            overflow: hidden;
            border: none !important;
            padding: 48px 40px 36px 40px;
            min-height: 700px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            max-width: 520px;
        }
        .logo-container {
            display: flex;
            justify-content: center;
            padding: 30px 30px 0;
        }
        .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #48E5C2 0%, #F3D3BD 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px #F3D3BD22;
            border: 3px solid #48E5C2;
            overflow: hidden;
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }
        .auth-header {
            padding: 20px 30px 10px;
            text-align: center;
        }
        .auth-header h1 {
            font-size: 28px;
            color: #48E5C2;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .auth-header p {
            color: #fff;
            font-size: 14px;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #F3D3BD, transparent);
            margin: 0 30px;
        }
        .auth-body {
            padding: 0;
            margin-top: 18px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 18px;
        }
        .form-group {
            margin-bottom: 0;
        }
        .form-group.full {
            grid-column: 1 / 3;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #48E5C2;
            font-size: 14px;
        }
        .form-control {
            width: 100%;
            padding: 16px 18px;
            border: 1.5px solid #48E5C2;
            border-radius: 16px;
            font-size: 17px;
            background: #F3D3BD;
            color: #333333;
            transition: all 0.3s;
            box-sizing: border-box;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #48E5C2;
            outline: none;
            box-shadow: 0 0 0 2px #48E5C299;
            background: #FCFAF9;
        }
        .btn-auth {
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, #48E5C2 0%, #333333 100%);
            color: #FCFAF9;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 28px;
            box-shadow: 0 4px 16px #5E5E5E;
        }
        .btn-auth:hover {
            background: linear-gradient(90deg, #333333 0%, #48E5C2 100%);
            box-shadow: 0 8px 24px #5E5E5E;
        }
        .auth-footer {
            text-align: center;
            color: #fff;
            font-size: 14px;
        }
        .auth-footer a {
            color: #48E5C2;
            text-decoration: none;
            font-weight: 500;
        }
        .tagline {
            text-align: center;
            margin-top: 24px;
            color: #F3D3BD;
            font-style: italic;
            font-size: 13px;
            grid-column: 1 / 3;
        }
        .error-message {
            color: #333333;
            font-size: 12px;
            margin-top: 5px;
        }
        @media (max-width: 700px) {
            .auth-container {
                max-width: 100vw;
                padding: 0 8px;
            }
            .auth-card {
                padding: 18px 4vw 18px 4vw;
                min-height: 520px;
                max-width: 98vw;
            }
            .form-control {
                font-size: 15px;
                padding: 12px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('imagens/enki.jpg') }}" alt="Logo ENKI">
                </div>
            </div>
            <div class="auth-header">
                <h1>CRIAR PERFIL</h1>
                <p>Preencha seus dados para cadastro</p>
            </div>
            <div class="divider"></div>
            <div class="auth-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nome">NOME COMPLETO</label>
                            <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" required>
                            @error('nome')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="matricula">MATRÍCULA</label>
                            <input type="text" id="matricula" name="matricula" class="form-control @error('matricula') is-invalid @enderror" value="{{ old('matricula') }}" required>
                            @error('matricula')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-MAIL</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telefone">TELEFONE</label>
                            <input type="tel" id="telefone" name="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone') }}" required>
                            @error('telefone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group full">
                            <label for="endereco">ENDEREÇO</label>
                            <input type="text" id="endereco" name="endereco" class="form-control @error('endereco') is-invalid @enderror" value="{{ old('endereco') }}" required>
                            @error('endereco')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">SENHA</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">CONFIRMAR SENHA</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="form-group full">
                            <button type="submit" class="btn-auth">CRIAR CONTA</button>
                        </div>
                        <div class="form-group full auth-footer">
                            Já possui uma conta? <a href="{{ route('login') }}">Faça login</a>
                        </div>
                        <div class="tagline">
                            Sistema de Gerenciamento de Biblioteca ENKI
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>