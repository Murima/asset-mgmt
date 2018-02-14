<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\GeneralAccessory;
use Illuminate\Http\Request;
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
    public function postCreateFromAsset($accessory_details){
        $save_details = array();

        $accessory_id = $accessory_details['accessory_id'];
        $from_asset_id = $accessory_details['asset_id'];
        foreach ($accessory_id as $id){

            $gAccessory = GeneralAccessory::find($id);
            $category_id = $gAccessory->category_id;
            $name = $gAccessory->accessory_name;
            $asset_id = $from_asset_id;

            $save_details['asset_id']= $asset_id;
            $save_details['category_id']= $category_id;
            $save_details['name']= $name;
            $save_details['qty']= 1;

            if (Accessory::where('asset_id', $save_details['asset_id'])->where('name', $save_details['name'])->exists() == false){
                $accessory = Accessory::create($save_details); //TODO measure performance of this
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
