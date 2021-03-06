<?php

namespace App\Console;

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
        Commands\PaveIt::class,
        Commands\CreateAdmin::class,
        Commands\SendExpirationAlerts::class,
        Commands\SendInventoryAlerts::class,
        Commands\LicenseImportCommand::class,
        Commands\ObjectImportCommand::class,
        Commands\Versioning::class,
        Commands\SystemBackup::class,
        Commands\DisableLDAP::class,
        Commands\Purge::class,
        Commands\LdapSync::class,
        Commands\AssetImportCommand::class,
        Commands\ChangeAssetDisposable::class,
        Commands\ImportUserCommand::class,
        Commands\AssetImportRequiredColumns::class,
        Commands\FixAssetTag::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('snipeit:inventory-alerts')->weekly();
        $schedule->command('snipeit:expiring-alerts')->weekly();
        $schedule->command('snipeit:backup')->weekly()->mondays()->fridays();
        $schedule->command('backup:clean')->monthly();
        //$schedule->command('asset:disposable')->daily();
    }
}
