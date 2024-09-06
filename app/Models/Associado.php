<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Associado extends Authenticatable
{
    protected $fillable = [
        'nome', 
        'cpf', 
        'email', 
        'password',
        'sexo',
    ];

    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
