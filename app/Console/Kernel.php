<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Console\Command;

class ScheduleBoletos extends Command
{
    protected $signature = 'boletos:sincronizar';
    protected $description = 'Sincroniza os boletos a cada hora';

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('boletos:sincronizar')->hourly();
    }

    public function handle()
    {
        
    }
}
