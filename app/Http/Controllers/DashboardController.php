<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Multa;
use App\Models\Acesso;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'emprestimos' => Emprestimo::count(),
            'multas' => Multa::where('paga', false)->sum('valor'),
            'acessos' => Acesso::count(),
            'grafico_emprestimos' => Emprestimo::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
                ->groupBy('mes')
                ->get()
        ];

        return view('dashboard', $data);
    }
}
