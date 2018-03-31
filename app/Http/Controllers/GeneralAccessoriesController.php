<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\GeneralAccessory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class GeneralAccessoriesController extends Controller
{

    /**
     * Store general accessories names from asset creation modal
     */
    public function store()
    {
        if (!GeneralAccessory::where('accessory_name', e(Input::get('name')))
            ->where('category_id', e(Input::get('category_id')))->exists()){
            $accessory = new GeneralAccessory();
            $accessory->accessory_name = e(Input::get('name'));
            $accessory->category_id = e(Input::get('category_id'));

            if ($accessory->save()) {
                return JsonResponse::create($accessory);
            } else {
                return JsonResponse::create(["error" => "Failed validation: ".print_r($accessory->getErrors()->all('<li>:message</li>'), true)], 500);
            }
        }
        else{
            return JsonResponse::create(["error" => "Already exists: "], 500);

        }

    }

    /**
     * creates accessories based on what user checked in asset creation page
     *
     */
    public function postCreateFromAsset($accessory_details, $checkout=null){
        $save_details = array();
        $company_id = Auth::user()->company->id;

        $accessory_id = $accessory_details['accessory_id'];
        foreach ($accessory_id as $id) {

            $gAccessory = GeneralAccessory::find($id);
            $category_id = $gAccessory->category_id;
            $name = $gAccessory->accessory_name;

            $save_details['category_id'] = $category_id;
            $save_details['name'] = $name;
            $save_details['qty'] = 1;
            $save_details['company_id'] = $company_id;
            $save_details['general_accessory_id'] = $id;

            $exists = Accessory::where('general_accessory_id', $id)->exists();
            if ($exists == false) {
                $accessory = Accessory::create($save_details); //TODO measure performance of this
                return true;
            } elseif($exists == true && $checkout) {
                $accessoryFound = Accessory::where('company_id', $save_details['company_id'])
                    ->where('name', $save_details['name'])
                    ->first();
                $remaining = $accessoryFound->numRemaining();
                if ($remaining >0){
                    return true;
                }
                else{
                    $accessoryFound->qty+=1;
                    $accessoryFound->save();
                    return true;

                }
            }
            else{

                $existingAccessory = Accessory::where('company_id', $save_details['company_id'])
                    ->where('name', $save_details['name'])
                    ->first();
                $existingAccessory->qty += 1;
                $existingAccessory->save();
            }
        }
    }

    /**
     * delete the general accessory name
     * @param $gAccessory
     */
    public function delete($gAccessoryId=null)
    {
        $gAccessoryIds = explode(',', $gAccessoryId);
        $result = null;

        foreach ($gAccessoryIds as $id){
            if (GeneralAccessory::find($id)->exists()){
                $gAccessory = GeneralAccessory::find($gAccessoryId);
                $gAccessory->delete();
                $result = true;
            }

            else{
                $result = false;
            }
        }

        return json_encode($result=true); //fix this
    }
}
