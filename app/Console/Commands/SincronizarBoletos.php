<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BoletoController;

class SincronizarBoletos extends Command
{
    // O nome e a descrição do comando no Artisan
    protected $signature = 'boletos:sincronizar';

    protected $description = 'Sincroniza boletos via API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      
        $boletoController = new BoletoController();
        $boletoController->sincronizarBoletos();

        $this->info('Sincronização de boletos concluída.');
    }
}
