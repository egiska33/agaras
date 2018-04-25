<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\CreateDailyReport;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\CreateDailyReport::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command(CreateDailyReport::class)->dailyAt('23:55');;
        // $schedule->command('inspire')
        //          ->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
