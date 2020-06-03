<?php

namespace App\Console;

use App\Auction;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            DB::select('SELECT check_auction_still_live()');
        })->everyMinute()->name('auction_live_to_over')->withoutOverlapping();
        $schedule->call(function() {
            DB::select('SELECT check_auction_still_pending()');
        })->everyMinute()->name('auction_pending_to_live')->withoutOverlapping();
        $schedule->call(function() {
            DB::select('SELECT check_user_suspended_status()');
        })->everyMinute()->name('user_unsuspend')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
