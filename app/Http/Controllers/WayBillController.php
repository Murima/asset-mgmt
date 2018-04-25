<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Asset;
use App\Models\Location;
use App\Models\User;
use App\Models\Waybill;
use Hamcrest\Core\IsNullTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;
use PDF;
use Symfony\Component\DomCrawler\Form;

class WayBillController extends Controller
{
    public function getView(){
        $all_users = Helper::usersList(true);

        return view('waybill/bulk_transfer')
            ->with('all_users', $all_users);
    }

    public function postBulkTransfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_number' => 'required',
            'cosignee'      => 'required',
            'cosignee_address' => 'required',
            'primary_contact'=> 'required',
            'primary_number' => 'required',
            'transporter_name'=> 'required',
            'transporter_number'=> 'required',
            'DOD'            => 'required|date',
            'ETA'            => 'required|date'
        ]);

        if ($validator->fails()){
            // return redirect()->withErrors($validator);
            return redirect('/')->withErrors('Validation failed');
        }

        if(Input::has('bulk_edit')){
            $assets = Asset::find(Input::get('bulk_edit'));
            $waybill = new Waybill();
            $waybill_info= array();

            $count = $assets->count();
            $lines =5;

            $form_data = Input::all();
            $location_id = Auth::user()->userloc->id;
            $form_data['waybill_no'] = Waybill::getWayBillNumber($location_id);
            $form_data['date_raised'] = date('Y-m-d');
            if (Input::get('cosignee')){
                $form_data['cosignee'] = User::find(Input::get('cosignee'));
            }
            if (Input::get('primary_contact')){
                $form_data['primary_contact'] = User::find(Input::get('primary_contact'));
            }
            if (Input::get('transporter_name')){
                $form_data['transporter_name'] = User::find(Input::get('transporter_name'));
            }
            $form_data['sender_email'] = Auth::user()->email;
            $form_data['sender'] = Auth::user();
            $form_data['date'] = date('Y-m-d'); //duplicated fix this
            $form_data['assets'] = $assets;
            $form_data['transport_type']= $form_data['transport_type'][0];
            $form_data['means']= $form_data['means'][0];

            if ($count< $lines){
                $lines = $lines- $count;
            }
            else{
                $lines=0;
            }
            $form_data['lines'] = $lines;

            foreach ($assets as $asset){
                if ($form_data['cosignee']->company_id){
                    $asset->company_id = $form_data['cosignee']->company_id;
                    $asset->rtd_location_id = $location_id;
                    $asset->transferred=1;
                    $asset->save();
                }

            }

            $waybill_info['waybill_no'] = $form_data['waybill_no'];
            $waybill_info['location_id']= $location_id;
            $waybill_info['sender'] = $form_data['sender_email'];
            $waybill_info['cosignee'] = $form_data['cosignee']->email;
            $waybill_info['origin'] = $form_data['origin'];
            if ($form_data['cosignee']->userloc->name){
                $waybill_info['destination'] = $form_data['cosignee']->userloc->name;
            }
            else{
                $waybill_info['destination']='';
            }
            $waybill_info['transporter']=$form_data['transporter_name']->email;
            $waybill->storeWayBill($waybill_info);

            $pdf = PDF::loadView('reports.waybill', $form_data)->setOrientation('landscape');
            return $pdf->inline('disposal_form.pdf');

        }
        else {
            return redirect()->to("hardware")->with('info', trans('admin/hardware/message.delete.nothing_updated'));

        }

    }

    public function testWaybillForm(){

        $form_data = array();

        $form_data['waybill_no'] = Waybill::getWayBillNumber(8);
        $form_data['sender_number'] = 999988;
        $form_data['cosignee'] =User::where('email', 'abdishakur.abdirahman@savethechildren.org')->first();
        $form_data['cosignee_address'] = 'Somalia';
        $form_data['primary_contact'] = User::where('email', 'mohamedahmed.abdi@savethechildren.org')->first();
        $form_data['primary_number'] = 77776;
        $form_data['transporter_name'] = User::where('email', 'mana.abdalla@savethechildren.org')->first();
        $form_data['transporter_number'] = 93938774;
        $form_data['DOD'] = date('Y-m-d');
        $form_data['ETA'] = date('Y-m-d');
        $form_data['sender_email'] = Auth::user()->email;
        $form_data['sender'] = Auth::user();
        $form_data['date'] = date('Y-m-d'); //duplicated fix this
        $form_data['origin'] ='Nairobi';
        $form_data['date_raised'] = date('Y-m-d');
        $form_data['vehicle_reg'] = 'slkdjfsldf';

        $pdf = PDF::loadView('reports.waybill', $form_data)
            ->setPaper('a4')
            ->setOrientation('landscape');

        return $pdf->inline('disposal_form.pdf');
    }
}
