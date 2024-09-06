<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_associado',
        'data_emissao',
        'valor',
        'status',
        'link_download',
        'data_vencimento', // Adicionar o campo
    ];
    
}
