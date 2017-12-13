<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\Company;
use App\Models\Location;
use App\Models\User;
use Illuminate\Console\Command;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputArgument;

class ImportUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:user-import {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports users from excel';

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
        $filename = $this->argument('filename');

        if (! ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        $csv = Reader::createFromPath($this->argument('filename'));
        $csv->setNewline("\r\n");
        $csv->setOffset(1);
        $duplicates = '';
        $keys = ['Global Staff ID','First Name', 'Last Name', 'Location', 'Job Position', 'Work Email'];
        $results = $csv->fetchAssoc($keys);

        foreach ($results as $row) {
            if (array_key_exists('Global Staff ID', $row)) {
                $emp_no = trim($row['Global Staff ID']);
            } else {
                $emp_no = '';
            }

            if (array_key_exists('First Name', $row)) {
                $first_name = trim($row['First Name']);

            } else {
                $first_name = '';
            }

            if (array_key_exists('Last Name', $row)) {
                $last_name = trim($row['Last Name']);
            } else {
                $last_name = '';
            }

            if (array_key_exists('Location', $row)) {
                $location = trim($row['Location']);
            } else {
                $location = '';
            }

            if (array_key_exists('Job Position', $row)) {
                $position = trim($row['Job Position']);
            } else {
                $position = '';
            }

            if (array_key_exists('Work Email', $row)) {
                $email = trim($row['Work Email']);
            } else {
                $email = '';
            }

            $user_notes='Imported from HR report';

            $user_username = substr($email, 0,strpos(e($email), '@'));
            $name_array = explode(".", $user_username);
            $first_name = $name_array[0];
            $last_name = $name_array[1];

            $pos = strpos($location, '#')+1;
            $substring = substr($location, $pos);
            $location = trim(explode("-", $substring)[0]);
            $company_id = "";

            $locationName = array(
                'NRB'      => 'Nairobi',
                'HAR'      => 'Hargeisa',
                'MOG'      => 'Mogadishu',
                'GAL'      => 'Galkaio', //TODO proper spelling
                'GAR'      => 'Gardo',
                'ABU'      => 'Abudwak',
                'BDO'      => 'Baidoa',
                'BOR'      => 'Borama',
                'BEL'      => 'Beledweyne',
                'BOS'      => 'Bossaso',
                'BUR'      => 'Burao',
                'DHO'      => 'Dhobley',
                'GRW'      => 'Garowe',
                'OTH'      => 'Other',
            );

            $location = Location::where('name', e($location))->first();
            if ($location) {
                $location_id = $location->id;
            }
            else{
                $location_id = "";
            }

            if ($location){
                $company_abbrev = array_search($location, $locationName);
                if ($company_abbrev){
                    $company_id = Company::where("name", $company_abbrev)->first()->id;
                }
            }
            else{
                $company_id = "";
            }
            $this->comment('First Name: '.$first_name);
            $this->comment('Last Name: '.$last_name);
            $this->comment('Username: '.$user_username);
            $this->comment('Email: '.$email);
            $this->comment('Location id: '.$location_id);
            $this->comment('Company id: '.$company_id);
            $this->comment('Location: '.$location);
            $this->comment('Position: '.$position);

            if ($user = User::MatchEmailOrUsername($user_username, e($email))
                ->whereNotNull('username')->first()) {
                $user->password = "assets123";
                $user->location_id = $location_id;
                $user->jobtitle = $position;
                $user->company_id = $company_id;
                $user->activated = 1;
                $user->employee_num = $emp_no;
                $user->notes = $user_notes;
                $user->save();
            }
            else{
                $user = new User();
                $user->first_name = $first_name;
                $user->last_name = $last_name;
                $user->location_id = $location_id;
                $user->company_id = $company_id;
                $user->username = $user_username;
                $user->email = $email;
                $user->password = "assets123";
                $user->activated = 1;
                $user->employee_num = $emp_no;
                $user->notes = $user_notes;
                $user->save();

            }

        }

    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('filename', InputArgument::REQUIRED, 'File for the CSV import.'),
        );
    }

}
