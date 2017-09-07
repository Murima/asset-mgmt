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
    //
    /**
     * Store general accessories from asset creation modal
     */
    public function store()
    {
        $accessory = new GeneralAccessory();
        $accessory->accessory_name = e(Input::get('name'));
        $accessory->category_id = e(Input::get('category_id'));

        if ($accessory->save()) {
            return JsonResponse::create($accessory);
        } else {
            return JsonResponse::create(["error" => "Failed validation: ".print_r($accessory->getErrors()->all('<li>:message</li>'), true)], 500);
        }


    }
}
