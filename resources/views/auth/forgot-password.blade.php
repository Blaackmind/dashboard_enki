<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - ENKI</title>
    <style>
        :root {
            --primary: #48E5C2;
            --secondary: #F3D3BD;
            --dark: #333333;
            --light: #FCFAF9;
            --gray: #5E5E5E;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        body {
            background-color: var(--light);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            background-image: none;
            background: var(--light);
        }
        
        .auth-container {
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.5s ease-out;
        }
        
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
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
            background-color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px #F3D3BD22;
            border: 3px solid var(--primary);
            overflow: hidden;
        }
        
        .logo img {
            max-width: 80%;
            max-height: 80%;
        }
        
        .auth-header {
            padding: 20px 30px 10px;
            text-align: center;
            position: relative;
        }
        
        .auth-header h1 {
            font-size: 28px;
            color: var(--primary);
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .auth-header p {
            color: var(--gray);
            font-size: 14px;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--secondary), transparent);
            margin: 0 30px;
        }
        
        .auth-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--primary);
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid var(--gray);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: var(--secondary);
            color: var(--dark);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px #48E5C233;
        }
        
        .btn-auth {
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: var(--light);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .btn-auth:hover {
            background: var(--dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px #5E5E5E;
        }
        
        .auth-footer {
            text-align: center;
            color: var(--gray);
            font-size: 14px;
        }
        
        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .tagline {
            text-align: center;
            margin-top: 15px;
            color: var(--primary);
            font-style: italic;
            font-size: 13px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="logo-container">
                <div class="logo">
                    <img src="imagens/enki.jpg" alt="Logo ENKI">
                </div>
            </div>
            
            <div class="auth-header">
                <h1>RECUPERAR SENHA</h1>
                <p>Informe seu e-mail para redefinição</p>
            </div>
            
            <div class="divider"></div>
            
            <div class="auth-body">
                <form>
                    <div class="form-group">
                        <label for="email">E-mail cadastrado</label>
                        <input type="email" id="email" class="form-control" placeholder="seu@email.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="matricula">Matrícula</label>
                        <input type="text" id="matricula" class="form-control" placeholder="Sua matrícula" required>
                    </div>
                    
                    <button type="submit" class="btn-auth">ENVIAR LINK</button>
                    
                    <div class="auth-footer">
                        Lembrou sua senha? <a href="login.html">Faça login</a>
                    </div>
                </form>
            </div>
            
            <div class="divider"></div>
            
            <div class="tagline">
                A sabedoria começa com o reconhecimento da própria ignorância.
            </div>
        </div>
    </div>
</body>
</html>