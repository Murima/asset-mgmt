<?php

namespace App\Console\Commands;

use App\Models\Asset;
use App\Models\Statuslabel;
use Illuminate\Console\Command;

class ChangeAssetDisposable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:disposable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This changes the status of assets that have reached EOL';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $disposable_id = StatusLabel::TextSearch("Disposable")->first()->id; //TODO stop hardcoding status labels
        $damaged_id = StatusLabel::TextSearch("Damaged")->first()->id;

        $eol_assets = Asset::where('archived', '=', '0')
            ->whereNotNull('purchase_date')
            ->whereNull('deleted_at')
            ->where('status_id', '!=', $disposable_id)
            ->where('status_id', '!=', $damaged_id)
            ->whereNotNull('model_id')->get();

        $this->info(count($eol_assets).' EOL assets');
        foreach ($eol_assets as $asset){
            $interval = $asset->months_until_eol();
            if (empty($interval)){
                $asset->status_id = $disposable_id;
                $asset->save();
            }
        }

    }
}
