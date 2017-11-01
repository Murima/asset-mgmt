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
            <td>878</td>
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
            <td>Gemo</td>
            <th>Position:</th>
            <td >Officer</td>
            <th>Signature</th>
            <td style="height: 50px;"></td>
        </tr>
    </table>
    <br>
    <table border="1">
        <tr>
            <th>Budget Holder:</th>
            <td>Gemo</td>
            <th>Position:</th>
            <td >Logs</td>
            <th>Signature</th>
            <td style="height: 40px;"></td>
        </tr>
        <tr>
            <th>Donor approval:</th>
            <td>Gemo</td>
            <th>Position:</th>
            <td ></td>
            <th>Signature</th>
            <td style="height: 40px;"></td>
        </tr>
        <tr>
            <th>CD approval:</th>
            <td>Bishop</td>
            <th>Position:</th>
            <td ></td>
            <th>Signature</th>
            <td style="height: 40px;"></td>
        </tr>
    </table>

    <br>
    <h2>Disposable Assets:</h2>
    <div style="display: table; bottom:0;width:100%; ">
        <table>
            <tr style="width: 30px;">
                <th>Name</th>
                <th>Asset tag</th>
                <th>Model</th>
            </tr>
            <tr>
                <td style="background-color: #413f28; color: #FFFFFF;">Bill Gates</td>
                <td style="background-color: #413f28; color: #FFFFFF">555 77 854</td>
                <td style="background-color: #413f28; color: #FFFFFF">555 77 855</td>
            </tr>
        </table>
    </div>
@stop
