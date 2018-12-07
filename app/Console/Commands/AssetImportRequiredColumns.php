<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Http\Controllers\CategoriesController;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Console\Command;

use App\Models\Statuslabel;
use App\Models\Location;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DateTime;
use League\Csv\Reader;
class AssetImportRequiredColumns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snipeit:asset-import2 {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import assets from selected columns';
    protected $allocated_id;
    protected $in_stock;
    protected $company_string;
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
        //
        $this->allocated_id = Statuslabel::where('name', 'Allocated')->first()->id;
        $this->in_stock = Statuslabel::where('name', 'In Stock')->first()->id;
        $filename = $this->argument('filename');
        $duplicates = '';


        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }
        $csv = Reader::createFromPath($this->argument('filename'));
        $csv->setNewline("\r\n");
        $csv->setOffset(1);

        // Loop through the records
        $nbInsert = $csv->each(function ($row) use ($duplicates) {
            $status_id = 1;

            // Company
            if (array_key_exists('0', $row)) {
                $asset_company = trim($row[0]);

            } else {
                $asset_company = '';
            }

            // Asset Category
            if (array_key_exists('1', $row)) {
                $asset_category_prefix = trim($row[1]);

            } else {
                $asset_category_prefix = '';
            }

            /*//Country
            if (array_key_exists('2', $row)) {
                $user_asset_country = Helper:: getCountryCode(trim($row[2]));
            } else {
                $user_asset_country = '';
            }*/

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

            //Asset assigned to (Email)
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

            // Asset Manufacturer
            if (array_key_exists('7', $row)) {
                $user_asset_mfgr = trim($row[7]);
            } else {
                $user_asset_mfgr = '';
            }

            //Manual Model
            if (array_key_exists('8', $row)) {
                $manual_model = trim($row[8]);
            } else {
                $manual_model = '';
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

            //Purchase date
            if (array_key_exists('13', $row)) {
                $user_asset_purchase_date = $row[13];
                $date_obj = date_create_from_format('d/m/Y', $row[12]);
                if (!empty($date_obj)) {
                    $user_asset_purchase_date = $date_obj->format('Y-m-d');
                }
            } else {
                $user_asset_purchase_date = '';
            }

            //PO Number
            if (array_key_exists('14', $row)) {
                $asset_po_no = trim($row[14]);
            } else {
                $asset_po_no = '';
            }

            //Purchase price
            if (array_key_exists('15', $row)) {//TODO convert to USD
                $user_asset_purchase_cost = trim($row[15]);
            } else {
                $user_asset_purchase_cost = '';
            }

            //Purchase currency
            if (array_key_exists('16', $row)) {
                $asset_currency = trim($row[16]);
            } else {
                $asset_currency = '';
            }

            //Purchase price in USD
            if (array_key_exists('17', $row)) {
                $asset_cost_usd = trim($row[17]);
            } else {
                $asset_cost_usd = '';
            }

            //Purchase location
            if (array_key_exists('18', $row)) {
                $asset_purchase_location = trim($row[18]);
            } else {
                $asset_purchase_location = '';
            }

            //Supplier
            if (array_key_exists('19', $row)) {
                $asset_supplier = trim($row[19]);
            } else {
                $asset_supplier = '';
            }

            //Warranty
            if (array_key_exists('20', $row)) {
                $asset_warranty = trim($row[20]);
            } else {
                $asset_warranty = '';
            }

            //SOF
            if (array_key_exists('21', $row)) {
                $asset_sof = trim($row[21]);
            } else {
                $asset_sof = '';
            }

            //Cost center
            if (array_key_exists('22', $row)) {
                $cost_center = trim($row[22]);
            } else {
                $cost_center = '';
            }

            //Project code
            if (array_key_exists('23', $row)) {
                $project_code = trim($row[23]);
            } else {
                $project_code = '';
            }

            //DEA
            if (array_key_exists('24', $row)) {
                $dea = trim($row[24]);
            } else {
                $dea = '';
            }

            //Account code
            if (array_key_exists('25', $row)) {
                $account_code = trim($row[25]);
            } else {
                $account_code = '';
            }

            //Award end date
            if (array_key_exists('26', $row)) {
                $award_end = trim($row[26]);
            } else {
                $award_end = '';
            }

            //Donor name
            if (array_key_exists('27', $row)) {
                $donor_name = trim($row[27]);
            } else {
                $donor_name = '';
            }

            //Plan after award end
            if (array_key_exists('28', $row)) {
                $plan_after_award = trim($row[28]);
            } else {
                $plan_after_award = '';
            }

            $user_email='';
            $user_asset_notes='Imported from asset register';
            $verify_email = filter_var($asset_assigned_to, FILTER_VALIDATE_EMAIL);

            $this->comment('Asset company: '.$asset_company);
            $this->comment('Email: '.$asset_assigned_to);
            $this->comment('Category Name: '.$asset_category_prefix);
            $this->comment('Manual model: '.$manual_model);
            $this->comment('Model Name: '.$asset_model);
            $this->comment('Manufacturer: '.$user_asset_mfgr);
            $this->comment('Model No: '.$user_asset_modelno);
            $this->comment('Serial No: '.$user_asset_serial);
            $this->comment('Location: '.$asset_region);
            $this->comment('Purchase Date: '.$user_asset_purchase_date);
            $this->comment('Purchase Cost: '.$user_asset_purchase_cost);
            $this->comment('Notes: '.$user_asset_notes);

            $this->comment('------------- Action Summary ----------------');

            //Company search
            $this->company_string = $asset_company;
            if ($asset_company!='') {
                if ($asset_company = Company::where('name', e($asset_company))->first()) {
                    $this->comment('Company already exists');
                } else {
                    $this->comment('Something went wrong! Company  was NOT created: ');
                }
            }

            //location search
            if ($location = Location::where('name', e($asset_region))->first()) {
                $this->comment('Location '.$asset_region.' already exists');
            } else {
                $location= null;
                $this->comment('Something went wrong! Location  was NOT created: ');
            }

            //Find user
            $user='';
            if (!empty($asset_assigned_to) && $verify_email != false) {
                $email_parts = explode('@', $asset_assigned_to);
                $user_username = $email_parts[0];

                if ($user = User::MatchEmailOrUsername($user_username, $asset_assigned_to)
                    ->whereNotNull('username')->first()) {
                    $this->comment('User '.$user_username.' already exists');
                } else {
                    $this->comment('User ' . $user_username . ' does not exist');
                    //create user if it does not exists
                    $user = new \App\Models\User;
                    $names = explode('.', $user_username);
                    $first_name =$names[0];
                    $last_name = $names[1];

                    $password  = 'assets123';
                    $user->first_name = $first_name;
                    $user->last_name = $last_name;
                    $user->username = $user_username;
                    $user->email = $user_email;
                    $user->permissions = '{user":1}';
                    $user->company_id = $asset_company->id;
                    $user->location_id = $location->id;
                    $user->password = bcrypt($password);
                    $user->activated = 1;
                    $user->notes = "Created from import";
                    if ($user->save()) {
                        $this->comment('User '.$first_name.' created');
                    } else {
                        $this->error('ERROR CREATING User '.$first_name.' '.$last_name);
                        $this->error($user->getErrors());
                    }


                }
            }

            //asset category prefix
            if (e($asset_category_prefix)=='') {
                $asset_category_prefix = 'Why???';
            } else {
                $asset_category_prefix = e($asset_category_prefix);
            }

            $category_name = Helper::getCategoryName(e($asset_category_prefix));
            $category = Category::where('name', $category_name)->where('category_type', 'asset')->first();


            $search =null;
            //Build model name
            switch ($asset_category_prefix){
                case 'CMP':
                    $model_name = e($asset_model)."/".e($user_asset_modelno);
                    $search = true;
                    break;
                case 'IT':
                    $model_name = $asset_description." ".e($asset_model)."/".e($user_asset_modelno);
                    $search = false;
                    break;
                case 'ELE':
                    $model_name = $asset_description." ".e($asset_model)."/".e($user_asset_modelno);
                    $search = false;
                    break;
                case 'CMS':
                    $model_name = $asset_description." ".e($asset_model)."/".e($user_asset_modelno);
                    $search = false;
                    break;
                case 'GEN':
                    $model_name = $asset_description." ".e($asset_model)."/".e($user_asset_modelno);
                    $search = false;
                    break;
                default:
                    $model_name = $asset_description." ".e($asset_model)."/".e($user_asset_modelno);
                    $search = false;
                    break;
            }

            $manufacturer = Manufacturer::where('name', e($user_asset_mfgr))->first();
            $this->comment('Model name', $model_name);
            if ($manufacturer){
                //manual search for model
                if ($search){
                    $asset_model = AssetModel::where('name', $manual_model )->first();
                }
                else {
                    $asset_model = AssetModel::where('name', $manual_model )->first();
                    //->where('manufacturer_id', $manufacturer->id)->first();
                }
                /* //search for model
                 if ($search){
                     $asset_model = AssetModel::where('name', $model_name )
                         ->where('model_number', e($user_asset_modelno))
                         ->where('category_id', $category->id)
                         ->where('manufacturer_id', $manufacturer->id)->first();
                 }
                 else {
                     $asset_model = AssetModel::where('name', $model_name )
                         ->where('model_number', e($user_asset_modelno))
                         ->where('category_id', $category->id)->first();
                     //->where('manufacturer_id', $manufacturer->id)->first();
                 }*/

            }

            if ($asset_model) {
                $this->comment('The Asset Model '.$manual_model.' with model number '.$user_asset_modelno.' already exists/ Model dets ');
            }
            else{
                $asset_model = '';
                $this->comment('Model not found');
            }

            //Supplier search
            if ($asset_supplier!='') {

                if ($asset_supplier = Supplier::where('name', e($asset_supplier))->first()) {
                    $this->comment('Supplier already exists');
                } else {
                    $supplier = new Supplier();
                    $supplier->name = e($asset_supplier);
                    $supplier->city = e($asset_purchase_location);

                    if ($supplier->save()) {
                        $this->comment('Supplier ' . $asset_supplier . ' was created');
                    } else {
/*                        $this->error('Something went wrong! Supplier ' . $asset_supplier . ' was NOT created: ' . $supplier->getErrors()->first());*/
                    }
                }
            }

            // Check for the asset match and create it if it doesn't exist
            $asset = Asset::where('serial', $user_asset_serial)
                ->where('rtd_location_id', $location->id)
                ->where('deleted_at', null)->first();
            if ($asset!=null)
            {

                $this->comment('The Asset with serial '.$user_asset_serial.' already exists');

                if ($user_asset_purchase_date!='') {
                    $asset->purchase_date = $user_asset_purchase_date;
                } else {
                    $asset->purchase_date = "";
                }
                if ($user_asset_purchase_cost!='') {
                    //$asset->purchase_cost = Helper::ParseFloat(e($user_asset_purchase_cost)); use USD cost
                    $asset->purchase_cost = Helper::parseFloat(e($asset_cost_usd));
                } else {
                    $asset->purchase_cost = 0.00;
                }
                $asset->serial = e($user_asset_serial);
                if ($asset_model !=''){
                    $asset->model_id =$asset_model->id;
                }
                else {
                    $asset->model_id = null;
                }


                if ($user){
                    if ($user->id){
                        $asset->assigned_to = $user->id;
                        $asset->status_id =$this->allocated_id;
                    }

                }
                else{
                    $asset->assigned_to = null;
                    $asset->status_id =$this->in_stock;

                }
                $asset->rtd_location_id = $location->id;
                $asset->user_id = 1;
                $asset->company_id = $asset_company->id;
                if ($asset_supplier!=''){
                    $asset->supplier_id = $asset_supplier->id;
                }
                else{
                    $asset->supplier_id= null;
                }

                $asset->physical =1;

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
                    $asset->_snipeit_cost_centre = $cost_center;
                } else {
                    $asset->_snipeit_cost_centre = null;
                }

                /* if (e($asset_other_no)!=''){
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
                if (e($asset_po_no)!=''){
                    $asset->_snipeit_po_number = $asset_po_no;
                } else {
                    $asset->_snipeit_po_number = null;
                }

                $asset->notes = $user_asset_notes;
                if ($asset->save()) {
                    $this->comment('Asset  with serial number '.$user_asset_serial.' was updated');
                } else {
                    $this->error('Something went wrong! Asset  was NOT updated: '.$asset->getErrors()->first());
                }
                //create new asset instead
            } else {
                $asset = new Asset();
                //$asset->name = e($user_asset_asset_name);
                if (!empty($user_asset_purchase_date)) {
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
                $asset->asset_tag = Asset::autoincrement_asset($asset_category_prefix,$this->company_string);
                $asset->model_id = $asset_model->id;
                if ($user){
                    $asset->assigned_to = $user->id;
                    $asset->status_id = $this->allocated_id;
                }
                else{
                    $asset->assigned_to = null;
                    $asset->status_id = $this->in_stock;

                }
                $asset->rtd_location_id = $location->id;
                $asset->user_id = 1;
                $asset->company_id = $asset_company->id;
                if ($asset_supplier!=''){
                    $asset->supplier_id = $asset_supplier->id;
                }
                else{
                    $asset->supplier_id= null;
                }


                $asset->physical =1;
                if (e($asset_warranty) && is_int($asset_warranty)) {
                    $asset->warranty_months = e($asset_warranty);
                } else {
                    $asset->warranty_months = '';
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
                    $asset->_snipeit_cost_centre = $cost_center;
                } else {
                    $asset->_snipeit_cost_centre = null;
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

                if (e($donor_name)!=''){
                    $asset->_snipeit_po_number = $asset_po_no;
                } else {
                    $asset->_snipeit_po_number = null;
                }

                $asset->notes = $user_asset_notes;
                if ($asset->save()) {
                    $this->comment('Asset with serial number '.$user_asset_serial.' was created');
                } else {
                    $this->error('Something went wrong! Asset  was NOT created: '.$asset->getErrors()->first());
                }

            }
            $this->comment('=====================================');

            return true;
        });
    }
}
