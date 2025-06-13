<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|string|max:20|unique:users',
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
        ]);

        $user = User::create([
            'matricula' => $request->matricula,
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}