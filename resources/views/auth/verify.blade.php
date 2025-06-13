<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delegação de Poderes - ENKI</title>
    
    <style>

        
        .delegation-steps {
            margin-bottom: 25px;
        }
        
        .step {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }
        
        .step-number {
            background: var(--primary);
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            font-size: 12px;
            flex-shrink: 0;
        }
        
        .step-content {
            flex: 1;
        }
        
        .step-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .step-description {
            color: var(--gray);
            font-size: 13px;
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
                <h1>DELEGAÇÃO DE PODERES</h1>
                <p>Configure as permissões de acesso</p>
            </div>
            
            <div class="divider"></div>
            
            <div class="auth-body">
                <form>
                    <div class="form-group">
                        <label for="delegate-email">E-mail do Delegado</label>
                        <input type="email" id="delegate-email" class="form-control" placeholder="delegado@email.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="permissions">Nível de Permissão</label>
                        <select id="permissions" class="form-control" required>
                            <option value="">Selecione um nível</option>
                            <option value="read">Somente Leitura</option>
                            <option value="write">Leitura e Escrita</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="validity">Validade</label>
                        <input type="date" id="validity" class="form-control" required>
                    </div>
                    
                    <div class="delegation-steps">
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <div class="step-title">Informe o e-mail do delegado</div>
                                <div class="step-description">O usuário receberá um e-mail com as instruções</div>
                            </div>
                        </div>
                        
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <div class="step-title">Defina as permissões</div>
                                <div class="step-description">Escolha o nível de acesso adequado</div>
                            </div>
                        </div>
                        
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <div class="step-title">Estabeleça a validade</div>
                                <div class="step-description">Determine até quando a delegação será válida</div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-auth">DELEGAR PODERES</button>
                    
                    <div class="auth-footer">
                        <a href="dashboard.html">Voltar ao painel</a>
                    </div>
                </form>
            </div>
            
            <div class="divider"></div>
            
            <div class="tagline">
                O poder compartilhado é poder multiplicado.
            </div>
        </div>
    </div>
</body>
</html>