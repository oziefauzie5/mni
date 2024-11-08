<?php

namespace App\Console;

use App\Jobs\invoiceJob;
use App\Jobs\ProsesBayarPengurus;
use App\Jobs\ProssesIsolir;
use App\Jobs\ProssesSuspand;
use App\Jobs\ProssesTagihan;
use App\Jobs\SendMessage;
use App\Jobs\WaJob;
use App\Jobs\WhatsappInvoiceJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->job(new SendMessage)->everyTwentySeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
