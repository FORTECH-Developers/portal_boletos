<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController extends Controller
{
    use ValidatesRequests;

    // Método que processa o login via CPF
    public function login(Request $request)
    {
        // Validação dos dados de entrada (CPF deve ser numérico e ter 11 dígitos)
        $this->validate($request, [
            'cpf' => 'required|digits:11',
            'password' => 'required|string|min:8',
        ]);

        // Remover a formatação do CPF (caso haja)
        $credentials = [
            'cpf' => preg_replace('/[^0-9]/', '', $request->cpf), // Remove caracteres não numéricos do CPF
            'password' => $request->password,
        ];

        // Tentativa de autenticação
        if (Auth::attempt($credentials)) {
            // Login bem-sucedido, redireciona para o dashboard
            return redirect()->intended('/dashboard');
        }

        // Autenticação falhou
        return redirect()->back()->withErrors(['cpf' => 'CPF ou senha inválidos']);
    }

    // Método para logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Redireciona para a página de login após logout
    }
}
