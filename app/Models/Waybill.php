<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Waybill extends Model
{
    /**
     * Get waybill number
     * @param $location_id
     * @return null|string
     */


    public static function getWayBillNumber($location_id){

        $waybill_prefix = 'WB';
        $year = date('Y');
        $exists = Location::find($location_id);
        $region = Auth::user()->company->name;
        if($exists && $region){

            $office = Location::find($location_id)->name;
            $waybill_no = DB::table('waybills')
                ->where('location_id', '=', $location_id)
                ->max('waybill_no');

            $waybill_array = explode('/', $waybill_no);
            $waybill_no = end($waybill_array);

            $padded_number = Asset::zerofill($waybill_no+1,5);

            return $waybill_prefix.'/'.$region.'/'.$year.'/'.$padded_number;

        }else{
            return NULL;
        }

    }

    /**
     * stores waybill information
     */
    public function storeWayBill($waybill_info){
        $this->waybill_no= $waybill_info['waybill_no'];
        $this->location_id= $waybill_info['location_id'];
        $this->sender= $waybill_info['sender'];
        $this->cosignee= $waybill_info['cosignee'];
        $this->origin= $waybill_info['origin'];
        $this->destination= $waybill_info['destination'];
        $this->transporter= $waybill_info['transporter'];

        $this->save();
    }

}
