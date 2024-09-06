<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'cpf', // Adicione o CPF se não estiver
        'password',
    ];

    // Override method to authenticate by CPF instead of email
    public function getAuthIdentifierName()
    {
        return 'cpf';
    }
}
