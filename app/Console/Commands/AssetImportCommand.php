<?php
namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\Accessory;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Location;
use App\Models\Category;
use App\Models\AssetModel;
use App\Models\Company;
use App\Models\Asset;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Illuminate\Console\Command;
use League\Csv\Reader;

class AssetImportCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    //protected $name = 'snipeit:asset-import';

    /**
     * Signature of the command
     */
    protected $signature ='snipeit:asset-import {filename} {--email_format=} {--username_format=} {--testrun}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Assets from CSV';

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
        $filename = $this->argument('filename');


        if (!$this->option('testrun')=='true') {
            $this->comment('======= Importing Assets from '.$filename.' =========');
        } else {
            $this->comment('====== TEST ONLY Asset Import for '.$filename.' ====');
            $this->comment('============== NO DATA WILL BE WRITTEN ==============');
        }

        if (! ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        $csv = Reader::createFromPath($this->argument('filename'));
        $csv->setNewline("\r\n");
        $csv->setOffset(1);
        $duplicates = '';

        // Loop through the records
        $nbInsert = $csv->each(function ($row) use ($duplicates) {
            $status_id = 1;


            //asset id
            if (array_key_exists('0', $row)) {
                $asset_id = trim($row[0]);
            } else {
                $asset_id = '';
            }

            // Asset Category
            if (array_key_exists('1', $row)) {
                $asset_category_prefix = trim($row[1]);

            } else {
                $asset_category_prefix = '';
            }

            //Country
            if (array_key_exists('2', $row)) {
                $user_asset_country = Helper:: getCountryCode(trim($row[2]));
            } else {
                $user_asset_country = '';
            }

            //Issuing office
            if (array_key_exists('3', $row)) {
                $asset_issuing_office = trim($row[3]);
            } else {
                $asset_issuing_office = '';
            }

            //Region
            if (array_key_exists('4', $row)) {
                $asset_region = trim($row[4]);
            } else {
                $asset_region = '';
            }

            //Asset assigned to
            if (array_key_exists('5', $row)) {
                $asset_assigned_to = trim($row[5]);
            } else {
                $asset_assigned_to = '';
            }

            //Asset description
            if (array_key_exists('6', $row)) {
                $asset_description = trim($row[6]);
            } else {
                $asset_description = '';
            }

            //Accessories
            if (array_key_exists('7', $row)) {
                $asset_accessories = trim($row[7]);
            } else {
                $asset_accessories = '';
            }

            // Asset Manufacturer
            if (array_key_exists('8', $row)) {
                $user_asset_mfgr = trim($row[8]);
            } else {
                $user_asset_mfgr = '';
            }

            //Model
            if (array_key_exists('9', $row)) {
                $asset_model = trim($row[9]);
            } else {
                $asset_model = '';
            }

            //Model number
            if (array_key_exists('10', $row)) {
                $user_asset_modelno = trim($row[10]);
            } else {
                $user_asset_modelno = '';
            }

            //Serial number
            if (array_key_exists('11', $row)) {
                $user_asset_serial = trim($row[11]);
            } else {
                $user_asset_serial = '';
            }

            //Other numbers
            if (array_key_exists('12', $row)) {
                $asset_other_no = trim($row[12]);
            } else {
                $asset_other_no = '';
            }

            //Asset tag
            if (array_key_exists('13', $row)) {
                $user_asset_tag = trim($row[13]);
            } else {
                $user_asset_tag = '';
            }

            //Agresso ID
            if (array_key_exists('14', $row)) {
                $asset_aggresso = trim($row[14]);
            } else {
                $asset_aggresso = '';
            }

            //Purchase date
            if (array_key_exists('15', $row)) {
                $user_asset_purchase_date = date("Y-m-d 00:00:01", strtotime($row[15]));
            } else {
                $user_asset_purchase_date = '';
            }

            //PO Number
            if (array_key_exists('16', $row)) {
                $asset_po_no = trim($row[16]);
            } else {
                $asset_po_no = '';
            }

            //Purchase price
            if (array_key_exists('17', $row)) {
                $user_asset_purchase_cost = trim($row[17]);
            } else {
                $user_asset_purchase_cost = '';
            }

            //Purchase currency
            if (array_key_exists('18', $row)) {
                $asset_currency = trim($row[18]);
            } else {
                $asset_currency = '';
            }

            //Purchase price in USD
            if (array_key_exists('19', $row)) {
                $asset_cost_usd = trim($row[19]);
            } else {
                $asset_cost_usd = '';
            }

            //Purchase location
            if (array_key_exists('20', $row)) {
                $asset_purchase_location = trim($row[20]);
            } else {
                $asset_purchase_location = '';
            }

            //Supplier
            if (array_key_exists('21', $row)) {
                $asset_supplier = trim($row[21]);
            } else {
                $asset_supplier = '';
            }

            //Warranty period
            if (array_key_exists('22', $row)) {
                $asset_warranty = trim($row[22]);
            } else {
                $asset_warranty = '';
            }

            //Capital non Capital
            if (array_key_exists('23', $row)) {
                $capital_non_capital = trim($row[23]);
            } else {
                $capital_non_capital = '';
            }

            //SOF
            if (array_key_exists('24', $row)) {
                $asset_sof = trim($row[24]);
            } else {
                $asset_sof = '';
            }

            //Cost center
            if (array_key_exists('25', $row)) {
                $cost_center = trim($row[25]);
            } else {
                $cost_center = '';
            }

            //Project code
            if (array_key_exists('26', $row)) {
                $project_code = trim($row[26]);
            } else {
                $project_code = '';
            }

            //DEA
            if (array_key_exists('27', $row)) {
                $dea = trim($row[27]);
            } else {
                $dea = '';
            }

            //Account code
            if (array_key_exists('28', $row)) {
                $account_code = trim($row[28]);
            } else {
                $account_code = '';
            }

            //Award end date
            if (array_key_exists('29', $row)) {
                $award_end = trim($row[29]);
            } else {
                $award_end = '';
            }

            //Donor name
            if (array_key_exists('30', $row)) {
                $donor_name = trim($row[30]);
            } else {
                $donor_name = '';
            }

            //Plan after award end
            if (array_key_exists('31', $row)) {
                $plan_after_award = trim($row[31]);
            } else {
                $plan_after_award = '';
            }


            /* // User's name
             if (array_key_exists('15', $row)) {
                 $user_name = trim($row[0]);
             } else {
                 $user_name = '';
             }

             // User's email
             if (array_key_exists('16', $row)) {
                 $user_email = trim($row[1]);
             } else {
                 $user_email = '';
             }

             // User's email
             if (array_key_exists('2', $row)) {
                 $user_username = trim($row[2]);
             } else {
                 $user_username = '';
             }

             // Asset Name
             if (array_key_exists('3', $row)) {
                 $user_asset_asset_name = trim($row[3]);
             } else {
                 $user_asset_asset_name = '';
             }

             // Asset Category
             if (array_key_exists('5', $row)) {
                 $user_asset_category_description = trim($row[4]);
             } else {
                 $user_asset_category_description = '';
             }

             // Asset Name
             if (array_key_exists('5', $row)) {
                 $user_asset_name = trim($row[5]);
             } else {
                 $user_asset_name = '';
             }



             // Asset model number
             if (array_key_exists('7', $row)) {
                 $user_asset_modelno = trim($row[7]);
             } else {
                 $user_asset_modelno = '';
             }

             // Asset serial number
             if (array_key_exists('8', $row)) {
                 $user_asset_serial = trim($row[8]);
             } else {
                 $user_asset_serial = '';
             }

             // Asset tag
             if (array_key_exists('9', $row)) {
                 $user_asset_tag = trim($row[9]);
             } else {
                 $user_asset_tag = '';
             }

             // Asset location
             if (array_key_exists('10', $row)) {
                 $user_asset_location = trim($row[10]);
             } else {
                 $user_asset_location = '';
             }

             // Asset notes
             if (array_key_exists('11', $row)) {
                 $user_asset_notes = trim($row[11]);
             } else {
                 $user_asset_notes = '';
             }

             // Asset purchase date
             if (array_key_exists('12', $row)) {
                 if ($row[12]!='') {
                     $user_asset_purchase_date = date("Y-m-d 00:00:01", strtotime($row[12]));
                 } else {
                     $user_asset_purchase_date = '';
                 }
             } else {
                 $user_asset_purchase_date = '';
             }

             // Asset purchase cost
             if (array_key_exists('13', $row)) {
                 if ($row[13]!='') {
                     $user_asset_purchase_cost = trim($row[13]);
                 } else {
                     $user_asset_purchase_cost = '';
                 }
             } else {
                 $user_asset_purchase_cost = '';
             }*/

            // Asset Company Name
            //assuming asset location is the region

            /*if (array_key_exists('4', $row)) {
                if ($row[4]!='') {
                    $user_asset_company_name = $asset_region
                } else {
                        $user_asset_company_name= '';
                }
            } else {
                   $user_asset_company_name = '';
            }*/


            $user_email='';
            $user_asset_notes='Imported from asset register';
            $user_username='';
            $tag_array = explode("-", $user_asset_tag);
            $user_asset_company_name= $tag_array[1];  //TODO use COMPANY to generate tags later

            $user_asset_name = explode(" ", trim($asset_description));
            // A number was given instead of a name
            if (is_numeric($asset_assigned_to)) {
                $this->comment('User '.$asset_assigned_to.' is not a name - assume this user already exists');
                $user_username = '';
                $first_name = '';
                $last_name = '';

                // No name was given
            } elseif ($asset_assigned_to=='') {
                $this->comment('No user data provided - skipping user creation, just adding asset');
                $first_name = '';
                $last_name = '';
                //$user_username = '';

            }
            else {
                $user_email_array = User::generateFormattedNameFromFullName($this->option('email_format'), $asset_assigned_to);
                $first_name = $user_email_array['first_name'];
                $last_name = $user_email_array['last_name'];

                if ($user_email=='') {
                    $user_email = $user_email_array['username'].'@'.config('app.domain'); //generate email
                }

                if ($user_username=='') {
                    if ($this->option('username_format')=='email') {
                        $user_username = $user_email;
                    } else {
                        $user_name_array = User::generateFormattedNameFromFullName($this->option('username_format'), $asset_assigned_to);
                        $user_username = $user_name_array['username'];
                    }

                }

            }

            //$this->comment('Full Name: '.$user_name);
            $this->comment('First Name: '.$first_name);
            $this->comment('Last Name: '.$last_name);
            $this->comment('Username: '.$user_username);
            $this->comment('Email: '.$user_email);
            $this->comment('Category Name: '.$asset_category_prefix);
            $this->comment('Model Name: '.$user_asset_name[2]);
            $this->comment('Manufacturer ID: '.$user_asset_mfgr);
            $this->comment('Model No: '.$user_asset_modelno);
            $this->comment('Serial No: '.$user_asset_serial);
            $this->comment('Asset Tag: '.$user_asset_tag);
            $this->comment('Location: '.$asset_region);
            $this->comment('Purchase Date: '.$user_asset_purchase_date);
            $this->comment('Purchase Cost: '.$user_asset_purchase_cost);
            $this->comment('Notes: '.$user_asset_notes);
            $this->comment('Company Name: '.$user_asset_company_name);

            $this->comment('------------- Action Summary ----------------');

            if ($user_username!='') {
                if ($user = User::MatchEmailOrUsername($user_username, $user_email)
                    ->whereNotNull('username')->first()) {
                    $this->comment('User '.$user_username.' already exists');
                } else {
                    $this->comment('User '.$user_username.' does not exist');

                    //users handled by local AD
                    /*$user = new \App\Models\User;
                    $password  = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);

                    $user->first_name = $first_name;
                    $user->last_name = $last_name;
                    $user->username = $user_username;
                    $user->email = $user_email;
                    $user->permissions = '{user":1}';
                    $user->password = bcrypt($password);
                    $user->activated = 1;
                    $user->notes = "Created from import";
                    if ($user->save()) {
                        $this->comment('User '.$first_name.' created');
                    } else {
                        $this->error('ERROR CREATING User '.$first_name.' '.$last_name);
                        $this->error($user->getErrors());
                    }*/

                }
            } else {
                $user = new User;
            }

            // Check for the location match and create it if it doesn't exist
            if ($location = Location::where('name', e($asset_region))->first()) {
                $this->comment('Location '.$asset_region.' already exists');
            } else {

                $location = new Location();

                if ($asset_region!='') {
                    $location->name = e($asset_region);
                    $location->address = '';
                    $location->city = '';
                    $location->state = '';
                    $location->country = e($user_asset_country);
                    $location->user_id = 1;

                    if (!$this->option('testrun')=='true') {

                        if ($location->save()) {
                            $this->comment('Location '.$asset_region.' was created');
                        } else {
                            $this->error('Something went wrong! Location '.$asset_region.' was NOT created');
                            $this->error($location->getErrors());
                        }

                    } else {
                        $this->comment('Location '.$asset_region.' was (not) created - test run only');
                    }
                } else {
                    $this->comment('No location given, so none created.');
                }

            }

            if (e($asset_category_prefix)=='') {
                $asset_category_prefix = 'Why???';
            } else {
                $asset_category_prefix = e($asset_category_prefix);
            }

            $category_name = Helper::getCategoryName(e($asset_category_prefix));

            // Check for the category match and create it if it doesn't exist
            if ($category = Category::where('name', $category_name)->where('category_type', 'asset')->first()) {
                $this->comment('Category '.$asset_category_prefix.' already exists');

            } else {
                $category = new Category();
                $category->name = $category_name;
                $category->category_type = 'asset';
                $category->category_prefix = $asset_category_prefix;
                $category->user_id = 1;

                if ($category->save()) {
                    $this->comment('Category '.$asset_category_prefix.' was created');
                } else {
                    $this->error('Something went wrong! Category '.$asset_category_prefix.' was NOT created');
                    $this->error($category->getErrors());
                }

            }

            // Check for the manufacturer match and create it if it doesn't exist
            if ($manufacturer = Manufacturer::where('name', e($user_asset_mfgr))->first()) {
                $this->comment('Manufacturer '.$user_asset_mfgr.' already exists');
            } else {
                $manufacturer = new Manufacturer();
                $manufacturer->name = e($user_asset_mfgr);
                $manufacturer->user_id = 1;

                if ($manufacturer->save()) {
                    $this->comment('Manufacturer '.$user_asset_mfgr.' was created');
                } else {
                    $this->error('Something went wrong! Manufacturer '.$user_asset_mfgr.' was NOT created: '. $manufacturer->getErrors()->first());
                }

            }

            // Check for the asset model match and create it if it doesn't exist
            $model_name = $category->name." ".e($asset_model)."/".e($user_asset_modelno);
            if ($asset_model = AssetModel::where('name', $model_name )
                ->where('model_number', e($user_asset_modelno))
                ->where('category_id', $category->id)
                ->where('manufacturer_id', $manufacturer->id)->first()) {
                $this->comment('The Asset Model '.$model_name.' with model number '.$user_asset_modelno.' already exists');
            } else {
                $asset_model = new AssetModel();
                $asset_model->name = $model_name;
                $asset_model->manufacturer_id = $manufacturer->id;
                $asset_model->specific_category = $category->name;
                $asset_model->model_number = e($user_asset_modelno);
                $asset_model->category_id = $category->id;
                $asset_model->user_id = 1;

                Log::info("in AssetImportCommand");
                if ($asset_model->save()) {
                    $this->comment('Asset Model '.$model_name.' with model number '.$user_asset_modelno.' was created');
                } else {
                    $this->error('Something went wrong! Asset Model '.$model_name.' was NOT created: '.$asset_model->getErrors()->first());
                }

            }

            // Check for the asset company match and create it if it doesn't exist
            if ($user_asset_company_name!='') {
                if ($company = Company::where('name', e($user_asset_company_name))->first()) {
                    $this->comment('Company '.$user_asset_company_name.' already exists');
                } else {
                    $company = new Company();
                    $company->name = e($user_asset_company_name);

                    if ($company->save()) {
                        $this->comment('Company '.$user_asset_company_name.' was created');
                    } else {
                        $this->error('Something went wrong! Company '.$user_asset_company_name.' was NOT created: '.$company->getErrors()->first());
                    }
                }

            } else {
                $company = new Company();
            }

            if ($asset_supplier!='') {

                if ($supplier = Supplier::where('name', e($asset_supplier))->first()) {
                    $this->comment('Supplier ' . $asset_supplier . ' already exists');
                } else {
                    $supplier = new Supplier();
                    $supplier->name = e($asset_supplier);
                    $supplier->city = e($asset_purchase_location);

                    if ($supplier->save()) {
                        $this->comment('Supplier ' . $asset_supplier . ' was created');
                    } else {
                        $this->error('Something went wrong! Supplier ' . $asset_supplier . ' was NOT created: ' . $supplier->getErrors()->first());
                    }
                }
            } else{
                $supplier = new Supplier();
            }

            // Check for the asset match and create it if it doesn't exist
            if ($asset = Asset::where('asset_tag', e($user_asset_tag))->first()) {
                $this->comment('The Asset with asset tag '.$user_asset_tag.' already exists');
            } else {
                $asset = new Asset();
                //$asset->name = e($user_asset_asset_name);
                if ($user_asset_purchase_date!='') {
                    $asset->purchase_date = $user_asset_purchase_date;
                } else {
                    $asset->purchase_date = null;
                }
                if ($user_asset_purchase_cost!='') {
                    $asset->purchase_cost = Helper::ParseFloat(e($user_asset_purchase_cost));
                } else {
                    $asset->purchase_cost = 0.00;
                }
                $asset->serial = e($user_asset_serial);
                $asset->asset_tag = e($user_asset_tag);
                $asset->model_id = $asset_model->id;
                $asset->assigned_to = $user->id;
                $asset->rtd_location_id = $location->id;
                $asset->user_id = 1;
                $asset->status_id = $status_id;
                $asset->company_id = $company->id;
                $asset->supplier_id = $supplier->id;

                $asset->physical =1;
                if (e($asset_warranty)) {
                    $asset->warranty_months = e($asset_warranty);
                } else {
                    $asset->warranty_months = '';
                }

                if ($user_asset_purchase_date!='') {
                    $asset->purchase_date = $user_asset_purchase_date;
                } else {
                    $asset->purchase_date = null;
                }

                if (e($account_code)!='') {
                    $asset->_snipeit_account_code = $account_code;
                } else {
                    $asset->_snipeit_account_code = null;
                }

                if (e($project_code)!='') {
                    $asset->_snipeit_project_code = $project_code;
                } else {
                    $asset->_snipeit_project_code = null;
                }

                if (e($cost_center)!='') {
                    $asset->_snipeit_cost_center = $cost_center;
                } else {
                    $asset->_sipeit_cost_center = null;
                }

               /* if (e($asset_other_no)!=''){ //TODO add this to assets
                    $asset->
                }*/

                if (e($dea)!='') {
                    $asset->_snipeit_dea = $dea;
                } else {
                    $asset->_snipeit_dea = null;
                }

                if (e($asset_sof)!='') {
                    $asset->_snipeit_sof = $asset_sof;
                } else {
                    $asset->_snipeit_sof = null;
                }

                if (e($plan_after_award)!='') {
                    $asset->_snipeit_plan_after_award_ends = $plan_after_award;
                } else {
                    $asset->_snipeit_plan_after_award_ends= null;
                }

                if (e($award_end)!='') {
                    $asset->_snipeit_award_end_date = $award_end;
                } else {
                    $asset->_snipeit_award_end_date = null;
                }

                if (e($donor_name)!=''){
                    $asset->_snipeit_donor_name = $donor_name;
                } else {
                    $asset->_snipeit_donor_name = null;
                }

                if (e($capital_non_capital)!=''){
                    $asset->capital_non_capital = $capital_non_capital;
                } else {
                    $asset->capital_non_capital = null;
                }

                $asset->notes = $user_asset_notes;
                if ($asset->save()) {
                    $this->comment('Asset '.$user_asset_tag.' with serial number '.$user_asset_serial.' was created');
                } else {
                    $this->error('Something went wrong! Asset '.$user_asset_tag.' was NOT created: '.$asset->getErrors()->first());
                }

            }

            //save accessories associated with the asset
            $accessories_array = explode(" ", e(trim($asset_accessories)));
            foreach ($accessories_array as $accessory) {
                if ($accessory = Accessory::where('name', $accessory)->where('asset_id', $asset->id)->first()) {

                    $this->comment('Accessory ' . $accessory . ' already exists');
                }
                else {
                    $_accessory = new Accessory();
                    $_accessory->name = $accessory;
                    $_accessory->asset_id = $asset->id;
                }
            }

            $this->comment('=====================================');

            return true;

        });


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


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('email_format', null, InputOption::VALUE_REQUIRED, 'The format of the email addresses that should be generated. Options are firstname.lastname, firstname, filastname', null),
            array('username_format', null, InputOption::VALUE_REQUIRED, 'The format of the username that should be generated. Options are firstname.lastname, firstname, filastname, email', null),
            array('testrun', null, InputOption::VALUE_REQUIRED, 'Test the output without writing to the database or not.', null),
        );
    }
}
