<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::with(['user', 'livro'])->latest()->paginate(10);
        return view('pages.emprestimos', compact('emprestimos'));
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
}