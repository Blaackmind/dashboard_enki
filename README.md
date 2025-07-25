# ENKI Dashboard - Sistema de Gestão de Biblioteca

Sistema completo de gestão de biblioteca desenvolvido em Laravel com dashboard interativo, gráficos, controle de empréstimos, usuários e relatórios.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes aplicativos instalados:

### Aplicativos Necessários:

1. **Laragon** (Recomendado)
   - Download: [https://laragon.org/download/](https://laragon.org/download/)
   - Inclui: Apache, MySQL, PHP, Composer, Git
   - Versão: 6.0 ou superior

2. **Node.js** (Para compilação de assets)
   - Download: [https://nodejs.org/](https://nodejs.org/)
   - Versão: 18.x ou superior
   - Inclui: npm (Node Package Manager)

3. **Git** (Para controle de versão)
   - Download: [https://git-scm.com/](https://git-scm.com/)
   - Ou já incluído no Laragon

### Alternativas ao Laragon:

- **XAMPP**: Apache + MySQL + PHP
- **WAMP**: Windows + Apache + MySQL + PHP
- **MAMP**: Mac + Apache + MySQL + PHP

## Passo a Passo de Instalação

### 1. Clone o Repositório

```bash
git clone [https://github.com/Blaackmind/DashboardEnki]
cd enki-dashboard
```

### 2. Instale as Dependências PHP

```bash
composer install
```

### 3. Configure o Arquivo de Ambiente

```bash
# Copie o arquivo de exemplo
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

### 4. Configure o Banco de Dados

Edite o arquivo `.env` com suas configurações:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=enki_dashboard
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Crie o Banco de Dados

- Abra o phpMyAdmin (via Laragon)
- Crie um banco de dados chamado `enki_dashboard`
- Ou execute via linha de comando:
```bash
mysql -u root -p -e "CREATE DATABASE enki_dashboard;"
```

### 6. Execute as Migrations

```bash
php artisan migrate
```

### 7. Execute os Seeders (Dados Iniciais)

```bash
php artisan db:seed
```

### 8. Instale as Dependências Node.js

```bash
npm install
```

### 9. Compile os Assets

```bash
# Para desenvolvimento
npm run dev

# Para produção
npm run build
```

### 10. Configure o Storage

```bash
# Crie o link simbólico para storage
php artisan storage:link
```

### 11. Configure Permissões (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

## Executando o Projeto

### Opção 1: Via Laragon (Recomendado)

1. Abra o Laragon
2. Clique em "Start All"
3. Acesse: `http://enki-dashboard.test` (ou `http://localhost/enki-dashboard`)

### Opção 2: Via Artisan (Servidor de Desenvolvimento)

```bash
php artisan serve
```

Acesse: `http://localhost:8000`

## Dados de Acesso Iniciais

Após executar os seeders, você terá acesso com:

- **Email**: `admin@enki.com`
- **Senha**: `password`

## Estrutura do Projeto

```
enki-dashboard/
├── app/
│   ├── Http/Controllers/     # Controllers da aplicação
│   ├── Models/              # Models Eloquent
│   └── View/Components/     # Componentes Blade
├── database/
│   ├── migrations/          # Migrations do banco
│   ├── seeders/            # Seeders com dados iniciais
│   └── factories/          # Factories para testes
├── resources/
│   ├── views/              # Views Blade
│   │   ├── pages/          # Páginas principais
│   │   ├── layouts/        # Layouts base
│   │   └── components/     # Componentes reutilizáveis
│   ├── js/                 # Arquivos JavaScript
│   └── css/                # Arquivos CSS
├── public/                 # Arquivos públicos
│   ├── imagens/            # Imagens do sistema
│   └── build/              # Assets compilados
└── routes/                 # Definição de rotas
```

## Funcionalidades Principais

### Dashboard
- Gráficos interativos de empréstimos, acessos e multas
- Cards com estatísticas em tempo real
- Tabela de categorias mais populares

### Gestão de Livros
- Cadastro e edição de livros
- Controle de categorias
- Gráficos de popularidade
- Relatórios por categoria

### Gestão de Usuários
- Cadastro de usuários
- Controle de perfis (admin, leitor, bibliotecário)
- Análise de acessos

### Empréstimos
- Controle de empréstimos e devoluções
- Sistema de multas por atraso
- Histórico de transações

### Relatórios
- Relatórios personalizados
- Exportação de dados
- Análises estatísticas

## Comandos Úteis

### Desenvolvimento
```bash
# Compilar assets em modo watch
npm run dev

# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Recarregar autoload
composer dump-autoload
```

### Banco de Dados
```bash
# Reverter migrations
php artisan migrate:rollback

# Recriar banco do zero
php artisan migrate:fresh --seed

# Verificar status das migrations
php artisan migrate:status
```

### Manutenção
```bash
# Modo manutenção
php artisan down
php artisan up

# Otimizar para produção
php artisan optimize
```

## Configurações Adicionais

### Configurar Virtual Host (Laragon)

1. Abra o Laragon
2. Clique em "Menu" → "Apache" → "Sites-enabled"
3. Adicione: `enki-dashboard.test` → `C:\caminho\para\enki-dashboard\public`

### Configurar SSL (Opcional)

```bash
# Gerar certificado SSL local
php artisan serve --host=0.0.0.0 --port=443 --tls-cert=localhost.pem --tls-key=localhost-key.pem
```

## Solução de Problemas

### Erro de Conexão com Banco
- Verifique se o MySQL está rodando
- Confirme as credenciais no `.env`
- Teste a conexão: `php artisan tinker`

### Erro de Permissões
```bash
# Windows (PowerShell como Admin)
icacls storage /grant Everyone:F /T
icacls bootstrap/cache /grant Everyone:F /T

# Linux/Mac
chmod -R 775 storage bootstrap/cache
```

### Assets não Carregam
```bash
# Recompile os assets
npm run build

# Verifique se o Vite está rodando
npm run dev
```

### Erro de Composer
```bash
# Limpar cache do Composer
composer clear-cache

# Reinstalar dependências
rm -rf vendor composer.lock
composer install
```

## Tecnologias Utilizadas

- **Backend**: Laravel 10.x
- **Frontend**: Blade Templates, Bootstrap 4
- **Gráficos**: Chart.js
- **Banco de Dados**: MySQL
- **Build Tool**: Vite
- **Autenticação**: Laravel Breeze, Laravel Sanctum e JWT Auth

## Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## Suporte

Para dúvidas ou problemas:
- Abra uma Issue no GitHub
- Entre em contato: [blaack.mind72@gmail.com]

---

**Desenvolvido para a gestão eficiente de bibliotecas**
