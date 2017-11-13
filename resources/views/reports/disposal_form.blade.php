@extends('layouts.default-excel')
{{--@section('title')
    <img src="{{ public_path('uploads/'.$snipeSettings->logo)}}" style="background-color: lightgrey; height: 60px; width: 100px;">
@stop--}}
@section('content')
    <table>
        <tr style="background-color: #154138; width: 50px;">
            <td>
                <img src="{{ public_path('uploads/'.$snipeSettings->logo)}}" style="height: 60px; width: 100px;">

            </td>
        </tr>
    </table>

    <table border="1">
        <tr>
            <th>Country:</th>
            <td style="margin-top: 50px; width: 20px;">Somalia</td>
        </tr>
        <tr>
            <th>Date:</th>
            <td>{{date("Y-m-d")}}</td>
        </tr>
        <tr>
            <th>Means of disposal:</th>
            <td>Donate</td>
        </tr>
    </table>
    <br>
    <br>
    <table border="1">
        <tr >
            <th>Requested by:</th>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <th>Position:</th>
            <td >Logistics Officer</td>
            <th>Signature</th>
            <td style="height: 50px;"></td>
        </tr>
    </table>
    <br>
    <table border="1">
        <tr>
            <th>Budget Holder:</th>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <th>Position:</th>
            <td >Logs</td>
            <th>Signature</th>
            <td style="height: 40px;"></td>
        </tr>
        <tr>
            <th>Donor approval:</th>
            <td>ECHO</td>
            <td></td>
            <th>Position:</th>
            <td ></td>
            <th>Signature</th>
            <td style="height: 40px;"></td>
        </tr>
        <tr>
            <th>CD approval:</th>
            <td>Timothy</td>
            <td>Bishop</td>
            <th>Position:</th>
            <td >Country Director</td>
            <th>Signature</th>
            <td style="height: 40px;"></td>
        </tr>
    </table>

    <br>
    <h2>Disposable Assets:</h2>
    <div style="display: table; bottom:0;width:100%; ">
        <table>
            <tr style="width: 30px;">
                <th>Category</th>
                <th>Asset tag</th>
                <th>Model</th>
                <th>Purchase cost</th>
                <th>Purchase date</th>
                <th>Order number</th>
                <th>End of life</th>
            </tr>
            <tr>
                {{-- @foreach($assets as $asset)--}}
                <td style="background-color: #413f28; color: #FFFFFF;">CMP</td>
                <td style="background-color: #413f28; color: #FFFFFF;">SOM-NRB-CMP-0033</td>
                <td style="background-color: #413f28; color: #FFFFFF;">1600</td>
                <td style="background-color: #413f28; color: #FFFFFF;">2017-08-01</td>
                <td style="background-color: #413f28; color: #FFFFFF;">po/op/9098</td>
                <td style="background-color: #413f28; color: #FFFFFF;"></td>
                <td style="background-color: #413f28; color: #FFFFFF;"></td>
                {{--<td style="background-color: #413f28; color: #FFFFFF;">{{$assets->asset_tag}}</td>
                <td style="background-color: #413f28; color: #FFFFFF;">{{$assets->model->name}}</td>
                <td style="background-color: #413f28; color: #FFFFFF;">{{$assets->purchase_cost}}</td>
                <td style="background-color: #413f28; color: #FFFFFF;">{{$assets->purchase_date}}</td>
                <td style="background-color: #413f28; color: #FFFFFF;">{{$assets->_snipeit_po_number}}</td>
                <td style="background-color: #413f28; color: #FFFFFF;">{{$assets->eol_date}}</td>--}}
                {{--@endforeach--}}
                <td style="background-color: #413f28; color: #FFFFFF"></td>
                <td style="background-color: #413f28; color: #FFFFFF"></td>
            </tr>
        </table>
    </div>
@stop
