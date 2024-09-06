<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boleto;

class BoletoSeeder extends Seeder
{
    public function run()
    {
        Boleto::create([
            'codigo_associado' => '12345',
            'data_emissao' => '2024-09-06',
            'valor' => 1200.50,
            'status' => 'Pendente',
            'link_download' => 'https://example.com/download/12345'
        ]);

        Boleto::create([
            'codigo_associado' => '67890',
            'data_emissao' => '2024-09-05',
            'valor' => 850.75,
            'status' => 'Pago',
            'link_download' => 'https://example.com/download/67890'
        ]);
    }
}
