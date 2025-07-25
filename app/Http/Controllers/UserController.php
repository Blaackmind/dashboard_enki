<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Emprestimo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        // Média de usuários registrados por mês (ano atual)
        $usuariosPorMes = User::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
        $meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        $mediaUsuariosMes = array_fill(0, 12, 0);
        foreach ($usuariosPorMes as $item) {
            $mediaUsuariosMes[$item->mes - 1] = (int)$item->total;
        }

        // Média de livros reservados por usuário
        $totalUsuarios = User::count();
        $totalReservas = \App\Models\Emprestimo::count();
        $mediaLivrosPorUsuario = $totalUsuarios > 0 ? round($totalReservas / $totalUsuarios, 2) : 0;

        // Taxa de avaliação (placeholder: % de usuários que fizeram pelo menos 1 empréstimo)
        $usuariosComEmprestimo = \App\Models\Emprestimo::distinct('user_id')->count('user_id');
        $taxaAvaliacao = $totalUsuarios > 0 ? round(($usuariosComEmprestimo / $totalUsuarios) * 100, 2) : 0;

        // Novos usuários no mês
        $novosUsuariosMes = User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        // Usuários ativos
        $usuariosAtivos = User::where('status', 'ativo')->count();

        // Busca e filtros
        $query = User::query();
        if ($request->filled('busca')) {
            $busca = $request->input('busca');
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%$busca%")
                  ->orWhere('email', 'like', "%$busca%")
                  ->orWhere('matricula', 'like', "%$busca%") ;
            });
        }
        if ($request->filled('perfil')) {
            $query->where('perfil', $request->input('perfil'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        $usuarios = $query->orderBy('nome')->paginate(10)->withQueryString();

        // Análise de acessos dos usuários (exemplo: total de acessos por mês)
        $acessosPorMes = \App\Models\Acesso::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
        $acessosLabels = $meses;
        $acessosData = array_fill(0, 12, 0);
        foreach ($acessosPorMes as $item) {
            $acessosData[$item->mes - 1] = (int)$item->total;
        }

        return view('pages.usuarios', [
            'meses' => $meses,
            'mediaUsuariosMes' => $mediaUsuariosMes,
            'mediaLivrosPorUsuario' => $mediaLivrosPorUsuario,
            'taxaAvaliacao' => $taxaAvaliacao,
            'totalUsuarios' => $totalUsuarios,
            'usuariosAtivos' => $usuariosAtivos,
            'novosUsuariosMes' => $novosUsuariosMes,
            'usuarios' => $usuarios,
            'acessosLabels' => $acessosLabels,
            'acessosData' => $acessosData,
        ]);
    }

    public function updatePerfil(Request $request, User $usuario)
    {
        $request->validate([
            'perfil' => 'required|in:admin,bibliotecario'
        ]);
        $usuario->perfil = $request->perfil;
        $usuario->save();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'perfil' => 'required|in:admin,bibliotecario',
            'matricula' => 'required|string|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'perfil' => $request->perfil,
            'matricula' => $request->matricula,
            'password' => bcrypt($request->password),
            'status' => 'ativo'
        ]);

        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function editAdmin()
    {
        $admin = auth()->user();
        return view('pages.admin-perfil', compact('admin'));
    }

    public function updateAdmin(Request $request)
    {
        $admin = auth()->user();
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'matricula' => 'required|string|unique:users,matricula,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        $admin->nome = $request->nome;
        $admin->email = $request->email;
        $admin->matricula = $request->matricula;
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();
        return redirect()->route('admin.perfil')->with('success', 'Dados atualizados com sucesso!');
    }

    public function destroy(User $usuario)
    {
        // Impede o admin de se autoexcluir
        if (auth()->id() === $usuario->id) {
            return redirect()->back()->with('error', 'Você não pode excluir a si mesmo.');
        }
        $usuario->delete();
        return redirect()->back()->with('success', 'Usuário excluído com sucesso!');
    }
} 