<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Emprestimo;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_or_bibliotecario');
    }

    public function index()
    {
        // Obter livros mais populares do mês atual
        $livrosPopulares = Livro::getLivrosMaisPopulares(10);
        
        // Obter estatísticas por categoria
        $estatisticasCategoria = Livro::getEstatisticasPorCategoria();
        
        // Obter dados para gráfico mensal
        $dadosGraficoMensal = Livro::getDadosGraficoMensal();
        
        // Estatísticas gerais
        $totalLivros = Livro::count();
        $livrosDisponiveis = Livro::count(); // Removida verificação de disponibilidade
        $totalEmprestimosMes = Emprestimo::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Preparar dados para os gráficos
        $dadosGraficoCategoria = [
            'labels' => $estatisticasCategoria->pluck('categoria')->toArray(),
            'data' => $estatisticasCategoria->pluck('total_emprestimos')->toArray(),
        ];
        
        $dadosGraficoMensal = [
            'labels' => $dadosGraficoMensal->pluck('mes')->map(function($mes) {
                return date('F', mktime(0, 0, 0, $mes, 1));
            })->toArray(),
            'data' => $dadosGraficoMensal->pluck('total')->toArray(),
        ];

        return view('pages.livros', compact(
            'livrosPopulares',
            'estatisticasCategoria',
            'dadosGraficoCategoria',
            'dadosGraficoMensal',
            'totalLivros',
            'livrosDisponiveis',
            'totalEmprestimosMes'
        ));
    }
} 