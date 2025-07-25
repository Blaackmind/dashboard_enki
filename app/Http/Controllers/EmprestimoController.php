<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_or_bibliotecario');
    }

    public function index()
    {
        $emprestimos = Emprestimo::with(['user', 'livro', 'multa'])->latest()->paginate(10);
        $totalEmprestimos = Emprestimo::count();
        $emprestimosAtivos = Emprestimo::where('status', 'ativo')->count();
        $emprestimosAtrasados = Emprestimo::where('status', 'atrasado')->count();
        $historicoMultas = \App\Models\Multa::with(['emprestimo.livro'])
            ->whereHas('emprestimo', function($q) { $q->where('user_id', auth()->id()); })
            ->orderByDesc('created_at')
            ->get();
        return view('pages.emprestimos', compact('emprestimos', 'totalEmprestimos', 'emprestimosAtivos', 'emprestimosAtrasados', 'historicoMultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'livro_id' => 'required|exists:livros,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao_prevista' => 'required|date|after:data_emprestimo'
        ]);

        Emprestimo::create($request->all());

        return redirect()->route('emprestimos')->with('success', 'Empréstimo registrado com sucesso!');
    }

    public function update(Request $request, Emprestimo $emprestimo)
    {
        $request->validate([
            'data_devolucao_prevista' => 'required|date|after:data_emprestimo',
            'status' => 'required|in:ativo,devolvido,atrasado'
        ]);

        $emprestimo->update($request->all());

        return redirect()->route('emprestimos')->with('success', 'Empréstimo atualizado com sucesso!');
    }

    public function destroy(Emprestimo $emprestimo)
    {
        $emprestimo->delete();
        return redirect()->route('emprestimos')->with('success', 'Empréstimo removido com sucesso!');
    }

    public function devolver(Emprestimo $emprestimo)
    {
        // Verifica atraso
        $hoje = now()->toDateString();
        $atrasado = $hoje > $emprestimo->data_devolucao_prevista;
        $emprestimo->status = $atrasado ? 'atrasado' : 'devolvido';
        $emprestimo->save();
        // Cria multa se atrasado
        if ($atrasado) {
            $diasAtraso = now()->diffInDays($emprestimo->data_devolucao_prevista, false) * -1;
            $valorMulta = $diasAtraso * 2.00; // Exemplo: R$2 por dia de atraso
            \App\Models\Multa::create([
                'emprestimo_id' => $emprestimo->id,
                'valor' => $valorMulta,
                'paga' => false
            ]);
        }
        return redirect()->back()->with('success', 'Devolução registrada com sucesso!');
    }
}