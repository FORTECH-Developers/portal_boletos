<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|digits:11|unique:users', 
            'password' => 'required|string|min:8|confirmed',
        ]);

        
        $user = User::create([
            'name' => $request->name,
            'cpf' => preg_replace('/[^0-9]/', '', $request->cpf), 
            'password' => Hash::make($request->password), 
        ]);

        
        Auth::login($user); 

        
        return redirect()->intended('/dashboard');
    }
}
