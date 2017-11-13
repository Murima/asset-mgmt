@extends('layouts.default-excel')
{{--@section('title')
    <img src="{{ public_path('uploads/'.$snipeSettings->logo)}}" style="background-color: lightgrey; height: 60px; width: 100px;">
@stop--}}
@section('content')
    <table>
        <tr style="background-color: #154138; width: 50px;">
            <td colspan="3" style="margin-left: auto; margin-right: auto">
                <img src="{{ public_path('uploads/'.$snipeSettings->logo)}}" style="height: 60px">

            </td>
        </tr>
    </table>

    <table border="1">
        <tr>
            <th>Country:</th>
            <td style="margin-top: 50px; width: 20px">Somalia</td>
        </tr>
        <tr>
            <th>Date:</th>
            <td>{{date("Y-m-d")}}</td>
        </tr>
        <tr>
            <th>Reason of disposal:</th>
            <td>{{$form_array['reason']}}</td>
        </tr>
        <tr>
            <th>Means of disposal:</th>
            <td>{{$form_array['disposal_methods']}}</td>
        </tr>
    </table>
    <br>
    <br>
    <table border="1">
        <tr >
            <th>Requested by:</th>
            <td>{{$form_array['requested_by']->first_name or 'NULL'}}</td>
            <td>{{$form_array['requested_by']->last_name or 'NULL'}}</td>
            <th>Position:</th>
            <td >{{$form_array['requested_by']->jobtitle or 'NULL'}}</td>
            <th>Signature:</th>
            <td style="height: 50px;"></td>
        </tr>
        <tr>
            <th>Budget Holder:</th>
            <td>{{$form_array['budget_holder']->first_name or 'NULL'}}</td>
            <td>{{$form_array['budget_holder']->last_name or 'NULL'}}</td>
            <th>Position:</th>
            <td >{{$form_array['budget_holder']->jobtitle or 'NULL'}}</td>
            <th>Signature:</th>
            <td style="height: 40px;"></td>
        </tr>

        <tr>
            <th>CD approval:</th>
            <td>{{$form_array['country_director']->first_name}}</td>
            <td>{{$form_array['country_director']->last_name}}</td>
            <th>Position:</th>
            <td >{{$form_array['country_director']->jobtitle}}</td>
            <th>Signature:</th>
            <td style="height: 40px;"></td>
        </tr>
        <tr>
            <th>Donor approval:</th>
            <td></td>
            <td></td>
            <th>Position:</th>
            <td ></td>
            <th>Signature:</th>
            <td style="height: 40px;"></td>
        </tr>
    </table>

    <br>
    <h2>Disposable Assets:</h2>
    <div style="display: table; bottom:0;width:100%; ">
        <table>
            <tr style="width: 30px;">
                <th>Item Category</th>
                <th>Asset tag</th>
                <th>Model</th>

                <th>Purchase cost</th>
                <th>Purchase date</th>
                <th>SOF</th>
                <th>Donor name</th>
                <th>Number</th>
                <th>Other Number</th>
                <th>End of Life</th>
            </tr>
            @foreach($assets as $asset)
                <tr style="border: 1px solid white;">

                    <td style="background-color: #413f28; color: #FFFFFF">{{\App\Helpers\Helper::getCategoryName($asset->asset_type)}}</td>
                    <td style="background-color: #413f28; color: #FFFFFF;">{{$asset->asset_tag}}</td>
                    <td style="background-color: #413f28; color: #FFFFFF">{{$asset->model->name or 'NULL'}}</td>

                    <td style="background-color: #413f28; color: #FFFFFF;text-align: center;">{{$asset->purchase_cost or 'NULL'}}</td>
                    <td style="background-color: #413f28; color: #FFFFFF;text-align: center;">{{$asset->purchase_date or 'NULL'}}</td>
                    <td style="background-color: #413f28; color: #FFFFFF;text-align: center;">{{$asset->_snipeit_sof or 'NULL'}}</td>
                    <td style="background-color: #413f28; color: #FFFFFF;">{{$asset->_snipeit_donor_name or 'NULL'}}</td>
                    <td style="background-color: #413f28; color: #FFFFFF">{{$asset->serial or 'NULL'}}</td>
                    <td style="background-color: #413f28; color: #FFFFFF"></td>
                    <td style="background-color: #413f28; color: #FFFFFF;">{{$form_array['eol']}}</td>
                </tr>

            @endforeach
        </table>
    </div>
@stop
