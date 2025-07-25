<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Emprestimo;
use App\Models\Acesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        // Estatísticas básicas do sistema
        $totalUsuarios = User::count();
        $totalLivros = \App\Models\Livro::count();
        $totalEmprestimos = Emprestimo::count();
        $totalMultas = \App\Models\Multa::count();
        
        // Configurações atuais do sistema (valores padrão)
        $configuracoes = [
            'prazo_padrao' => 15,
            'prazo_alunos' => 10,
            'prazo_professores' => 30,
            'renovacoes_permitidas' => 2,
            'max_livros_usuario' => 5,
            'max_livros_alunos' => 3,
            'max_livros_professores' => 8,
            'max_livros_bibliotecarios' => 10,
            'valor_multa_dia' => 2.50,
            'dias_tolerancia' => 3,
            'multa_maxima' => 50.00,
            'desconto_antecipado' => 10,
            'valor_minimo_bloqueio' => 10.00,
            'notif_email' => true,
            'notif_sistema' => true,
            'notif_atrasos' => false,
            'auto_ativar_usuarios' => true,
            'validar_email' => false,
            'matricula_obrigatoria' => true,
            'perfil_padrao' => 'leitor',
            'backup_automatico' => true,
            'frequencia_backup' => 'daily',
            'horario_backup' => '02:00',
            'retencao_backup' => 30,
        ];

        // Logs recentes do sistema
        $logsRecentes = $this->getLogsRecentes();

        return view('pages.configuracoes', [
            'totalUsuarios' => $totalUsuarios,
            'totalLivros' => $totalLivros,
            'totalEmprestimos' => $totalEmprestimos,
            'totalMultas' => $totalMultas,
            'configuracoes' => $configuracoes,
            'logsRecentes' => $logsRecentes,
        ]);
    }

    public function salvarConfiguracoes(Request $request)
    {
        $request->validate([
            'prazo_padrao' => 'required|integer|min:1|max:90',
            'prazo_alunos' => 'required|integer|min:1|max:90',
            'prazo_professores' => 'required|integer|min:1|max:90',
            'renovacoes_permitidas' => 'required|integer|min:0|max:5',
            'max_livros_usuario' => 'required|integer|min:1|max:20',
            'max_livros_alunos' => 'required|integer|min:1|max:10',
            'max_livros_professores' => 'required|integer|min:1|max:15',
            'max_livros_bibliotecarios' => 'required|integer|min:1|max:20',
            'valor_multa_dia' => 'required|numeric|min:0',
            'dias_tolerancia' => 'required|integer|min:0|max:7',
            'multa_maxima' => 'required|numeric|min:0',
            'desconto_antecipado' => 'required|integer|min:0|max:50',
            'valor_minimo_bloqueio' => 'required|numeric|min:0',
        ]);

        // Aqui você salvaria as configurações no banco de dados
        // Por enquanto, vamos apenas logar a ação
        Log::info('Configurações do sistema atualizadas', $request->all());

        return redirect()->back()->with('success', 'Configurações salvas com sucesso!');
    }

    public function salvarNotificacoes(Request $request)
    {
        $request->validate([
            'notif_email' => 'boolean',
            'notif_sistema' => 'boolean',
            'notif_atrasos' => 'boolean',
        ]);

        Log::info('Configurações de notificação atualizadas', $request->all());

        return redirect()->back()->with('success', 'Configurações de notificação salvas!');
    }

    public function salvarUsuarios(Request $request)
    {
        $request->validate([
            'auto_ativar_usuarios' => 'boolean',
            'validar_email' => 'boolean',
            'matricula_obrigatoria' => 'boolean',
            'perfil_padrao' => 'required|in:leitor,bibliotecario,admin',
        ]);

        Log::info('Configurações de usuários atualizadas', $request->all());

        return redirect()->back()->with('success', 'Configurações de usuários salvas!');
    }

    public function salvarBackup(Request $request)
    {
        $request->validate([
            'backup_automatico' => 'boolean',
            'frequencia_backup' => 'required|in:daily,weekly,monthly',
            'horario_backup' => 'required|date_format:H:i',
            'retencao_backup' => 'required|integer|min:1|max:365',
        ]);

        Log::info('Configurações de backup atualizadas', $request->all());

        return redirect()->back()->with('success', 'Configurações de backup salvas!');
    }

    public function fazerBackup()
    {
        // Aqui você implementaria a lógica de backup
        // Por enquanto, vamos apenas logar a ação
        Log::info('Backup manual iniciado');

        return redirect()->back()->with('success', 'Backup iniciado com sucesso!');
    }

    public function downloadBackup()
    {
        // Aqui você implementaria o download do backup
        Log::info('Download de backup solicitado');

        return redirect()->back()->with('success', 'Download iniciado!');
    }

    private function getLogsRecentes()
    {
        // Simulação de logs do sistema
        return [
            [
                'data' => now()->format('d/m/Y H:i'),
                'usuario' => 'admin@enki.com',
                'acao' => 'Login',
                'detalhes' => 'Login realizado com sucesso',
                'status' => 'Sucesso'
            ],
            [
                'data' => now()->subMinutes(5)->format('d/m/Y H:i'),
                'usuario' => 'joao@email.com',
                'acao' => 'Empréstimo',
                'detalhes' => 'Livro "Dom Casmurro" emprestado',
                'status' => 'Sucesso'
            ],
            [
                'data' => now()->subMinutes(10)->format('d/m/Y H:i'),
                'usuario' => 'maria@email.com',
                'acao' => 'Devolução',
                'detalhes' => 'Livro "O Cortiço" devolvido',
                'status' => 'Sucesso'
            ],
            [
                'data' => now()->subMinutes(15)->format('d/m/Y H:i'),
                'usuario' => 'admin@enki.com',
                'acao' => 'Configuração',
                'detalhes' => 'Alterada configuração de multas',
                'status' => 'Alteração'
            ],
            [
                'data' => now()->subMinutes(20)->format('d/m/Y H:i'),
                'usuario' => 'pedro@email.com',
                'acao' => 'Login',
                'detalhes' => 'Tentativa de login falhou',
                'status' => 'Erro'
            ],
        ];
    }

    public function exportarLogs()
    {
        // Aqui você implementaria a exportação dos logs
        Log::info('Exportação de logs solicitada');

        return redirect()->back()->with('success', 'Logs exportados com sucesso!');
    }
} 