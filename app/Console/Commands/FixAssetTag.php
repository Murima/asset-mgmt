<?php

namespace App\Console\Commands;

use App\Models\Asset;
use Illuminate\Console\Command;
use League\Csv\Reader;

class FixAssetTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:asset_tag_fix {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
    public function fire()
    {
        //
        $filename = $this->argument('filename');

        if (! ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        $csv = Reader::createFromPath($this->argument('filename'));
        $csv->setNewline("\r\n");
        $csv->setOffset(1);
        $duplicates='';

        $nbInsert = $csv->each(function ($row) use ($duplicates) {

            //asset id
            if (array_key_exists('0', $row)) {
                $asset_id = trim($row[0]);
            } else {
                $asset_id = '';
            }

            //asset_tag
            if (array_key_exists('1', $row)) {
                $asset_tag = trim($row[1]);
            } else {
                $asset_tag = '';
            }



            if (!empty($asset_id)){
                $asset = Asset::find($asset_id);
                $this->comment('asset_id'.$asset_id);
                $asset->asset_tag = $asset_tag;

                $asset->save();
            }

            $this->comment('------------- Action Summary ----------------');

            return true;
        });

    }
}
