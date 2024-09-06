<?php

use Illuminate\Support\Facades\Hash;
use App\Models\Associado;

Associado::create([
    'nome' => 'Andre',
    'cpf' => '04467095306',
    'email' => 'andre@example.com',
    'password' => Hash::make('04467095306'),
    'sexo' => 'M',
]);
