<?php

namespace App\Http\Controllers;

use App\Models\Associado;
use App\Models\Boleto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Buscar todos os associados e boletos do banco de dados
        $associados = Associado::all();
        $boletos = Boleto::all();

        // Retornar a view 'dashboard' com os associados e boletos
        return view('dashboard', compact('associados', 'boletos'));
    }
}
