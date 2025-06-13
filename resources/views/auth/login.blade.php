<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ENKI</title>
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #23395d 0%, #11998e 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            width: 100%;
            max-width: 440px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(35,57,93,0.90);
            border-radius: 24px;
            box-shadow: 0 8px 32px 0 rgba(35,57,93,0.25);
            overflow: hidden;
            border: none !important;
            padding: 40px 32px 32px 32px;
            min-height: 480px;
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            background: linear-gradient(135deg, #23395d 0%, #11998e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(17,153,142,0.15);
            border: 3px solid #19e6a7;
            overflow: hidden;
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }
        .login-header {
            padding: 20px 30px 10px;
            text-align: center;
        }
        .login-header h1 {
            font-size: 28px;
            color: #19e6a7;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .login-header p {
            color: #fff;
            font-size: 14px;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #19e6a7, transparent);
            margin: 0 30px;
        }
        .login-body {
            padding: 0;
            margin-top: 18px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #19e6a7;
            font-size: 14px;
        }
        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #19e6a7;
            border-radius: 14px;
            font-size: 15px;
            background: rgba(255,255,255,0.10);
            color: #fff;
            transition: all 0.3s;
            box-sizing: border-box;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #19e6a7 !important;
            outline: none;
            box-shadow: 0 0 0 2px #19e6a799;
            background: rgba(35,57,93,0.15);
        }
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .remember-me {
            display: flex;
            align-items: center;
        }
        .remember-me input {
            margin-right: 8px;
            accent-color: #19e6a7;
        }
        .remember-me label {
            color: #fff;
            font-size: 13px;
            font-family: inherit;
            font-weight: 400;
            margin-bottom: 0;
            margin-left: 4px;
            cursor: pointer;
        }
        .forgot-password {
            color: #19e6a7;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }
        .forgot-password:hover {
            color: #23395d;
        }
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, #23395d 0%, #11998e 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
            box-shadow: 0 4px 16px #11998e55;
        }
        .btn-login:hover {
            background: linear-gradient(90deg, #11998e 0%, #23395d 100%);
            box-shadow: 0 8px 24px #11998e88;
        }
        .register-link {
            text-align: center;
            color: #fff;
            font-size: 14px;
        }
        .register-link a {
            color: #19e6a7;
            text-decoration: none;
            font-weight: 500;
        }
        .error-message {
            color: #FFD700;
            font-size: 12px;
            margin-top: 5px;
        }
        @media (max-width: 600px) {
            .login-container {
                max-width: 100vw;
                padding: 0 8px;
            }
            .login-card {
                padding: 24px 6px 18px 6px;
                min-height: 340px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('imagens/enki.jpg') }}" alt="Logo ENKI">
                </div>
            </div>
            <div class="login-header">
                <h1>LOGIN</h1>
                <p>Entre com seus dados para acessar o sistema</p>
            </div>
            <div class="divider"></div>
            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">E-MAIL</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                        @error('email')
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
                    <div class="form-footer">
                        <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Lembrar-me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password">Esqueceu a senha?</a>
                    </div>
                    <button type="submit" class="btn-login">ENTRAR</button>
                </form>
                <div class="register-link">
                    Não possui uma conta? <a href="{{ route('register') }}">Cadastre-se</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>