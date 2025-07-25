<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Multa;
use App\Models\Acesso;
use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Meses do ano
        $meses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];

        // Contadores para os cards
        $livrosCount = Livro::count();
        $usuariosCount = User::count();
        $emprestimosCount = Emprestimo::where('status', 'ativo')->count();
        $atrasosCount = Emprestimo::where('status', 'atrasado')->count();

        // Empréstimos por mês
        $emprestimosPorMes = Emprestimo::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
        $dadosEmprestimos = array_fill(0, 12, 0);
        foreach ($emprestimosPorMes as $item) {
            $mesIdx = (int)$item->mes - 1;
            $total = (int)$item->total;
            if ($mesIdx >= 0 && $mesIdx < 12 && $total >= 0) {
                $dadosEmprestimos[$mesIdx] = $total;
            }
        }
        $dadosEmprestimos = array_map(function($v) {
            return (is_numeric($v) && $v >= 0) ? (int)$v : 0;
        }, $dadosEmprestimos);

        // Acessos por mês
        $acessosPorMes = Acesso::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
        $dadosAcessos = array_fill(0, 12, 0);
        foreach ($acessosPorMes as $item) {
            $mesIdx = (int)$item->mes - 1;
            $total = (int)$item->total;
            if ($mesIdx >= 0 && $mesIdx < 12 && $total >= 0) {
                $dadosAcessos[$mesIdx] = $total;
            }
        }
        $dadosAcessos = array_map(function($v) {
            return (is_numeric($v) && $v >= 0) ? (int)$v : 0;
        }, $dadosAcessos);

        // Multas por mês
        $multasPorMes = Multa::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
        $dadosMultas = array_fill(0, 12, 0);
        foreach ($multasPorMes as $item) {
            $mesIdx = (int)$item->mes - 1;
            $total = (int)$item->total;
            if ($mesIdx >= 0 && $mesIdx < 12 && $total >= 0) {
                $dadosMultas[$mesIdx] = $total;
            }
        }
        $dadosMultas = array_map(function($v) {
            return (is_numeric($v) && $v >= 0) ? (int)$v : 0;
        }, $dadosMultas);

        return view('dashboard', [
            'meses' => $meses,
            'dadosEmprestimos' => $dadosEmprestimos,
            'dadosAcessos' => $dadosAcessos,
            'dadosMultas' => $dadosMultas,
            'livrosCount' => $livrosCount,
            'usuariosCount' => $usuariosCount,
            'emprestimosCount' => $emprestimosCount,
            'atrasosCount' => $atrasosCount,
        ]);
    }
}

    