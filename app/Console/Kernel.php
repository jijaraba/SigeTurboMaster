<?php

namespace SigeTurbo\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \SigeTurbo\Console\Commands\Inspire::class,
        \SigeTurbo\Console\Commands\AttendancesLevel01::class,
        \SigeTurbo\Console\Commands\AttendancesLevel02::class,
        \SigeTurbo\Console\Commands\AttendancesLevel03::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sigeturbo:attendances_level01')
            ->timezone('America/Bogota')
            ->weekdays()
            ->at('08:46');
        $schedule->command('sigeturbo:attendances_level02')
            ->timezone('America/Bogota')
            ->weekdays()
            ->at('08:46');
        $schedule->command('sigeturbo:attendances_level03')
            ->timezone('America/Bogota')
            ->weekdays()
            ->at('07:40');
        //->dailyAt('21:01');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
