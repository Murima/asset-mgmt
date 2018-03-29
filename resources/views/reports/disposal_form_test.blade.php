@extends('layouts.default-excel')
@section('content')
    <div style="background-color: #03010b">
        <table>
            <tr>
                <td colspan="3" style="margin-left: auto; margin-right: auto;">
                    <img src="{{ public_path('uploads/'.$snipeSettings->logo)}}" style="height: 70px">

                </td>
            </tr>
        </table>

        <div style="text-align: center;
    text-decoration: underline;
    text-decoration-style:double;
    font-family: 'Times New Roman';
    font-weight: bold;
color: #FFFFFF;">
            <h2>ASSET DISPOSAL FORM</h2>
        </div>
        <div style="border-style: double; background-color: #FFFFFF">
            <table border="1" style="width: 50%;">
                <tr>
                    <th>Program:</th>
                    <td>Somalia</td>
                    <th>Date</th>
                    <th>{{$date}}</th>
                </tr>

            </table>
            <table border="1" style="width: 50%;">

                <tr>
                    <th>Reason for disposal</th>
                    <td>{{$reason}}</td>
                    <th>office</th>
                    <td>Nairobi</td>
                </tr>
                <tr>
                    <th>Asset Owner</th>
                    <td>SCI</td>
                    <th style="text-align: left">Donors Approval</th>
                    <td></td>
                </tr>
            </table>
            <br>
            <table border="1" style="width: 50%; margin: 10px 0 10px 0;">
                <th>Method of disposing</th>
                <tr>
                    <td style="background: #bbbbbb;">{{$disposal_methods}}</td>
                </tr>
            </table>
            <br>
            <table border="1" style="float: left;width: 50%;">
                <tr >
                    <th style="background: #bbbbbb;">Requested by:</th>
                    <td>{{$requested_by->first_name}}</td>
                    <td>{{$requested_by->last_name}}</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>{{$date}}</td>
                </tr>
                <tr>
                    <th>Position:</th>
                    <td>{{$requested_by->jobtitle}}</td>
                </tr>
                <tr>
                    <th>Signature:</th>
                    <td style="height: 50px;"></td>
                </tr>
                <tr >

            </table>

            <table border="1" style="width: 50%;">
                <tr >
                    <th style="background: #bbbbbb;">Budget holder:</th>
                    <td>{{$budget_holder->first_name}}</td>
                    <td>{{$budget_holder->last_name}}</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>{{$date}}</td>
                </tr>
                <tr>
                    <th>Position:</th>
                    <td>{{$budget_holder->jobtitle}}</td>
                </tr>
                <tr>
                    <th>Signature:</th>
                    <td style="height: 50px;"></td>
                </tr>
                <tr >

            </table>
            <br>
            <table border="1" style="float: left;width: 50%;">
                <tr >
                    <th style="background: #bbbbbb;text-align: left">Donor Approval:</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align: left">Date:</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align: left">Position:</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align: left;">Signature:</th>
                    <td style="height: 50px;"></td>
                </tr>
                <tr >

            </table>

            <table border="1" style="width: 50%;">
                <tr >
                    <th style="background: #bbbbbb;">Country Director:</th>
                    <td>{{$country_director->first_name}}</td>
                    <td>{{$country_director->last_name}}</td>
                </tr>
                <tr>
                    <th style="text-align: left">Date:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Position:</th>
                    <td>{{$country_director->jobtitle}}</td>
                </tr>
                <tr>
                    <th style="text-align: left">Signature:</th>
                    <td style="height: 50px;"></td>
                </tr>
                <tr >

            </table>
            <br>
            <div style="text-align: center;
    text-decoration: underline;
    text-decoration-style:dotted;
    font-family: 'Times New Roman';
    font-weight: bold;
color: #03010b;">
                <h3>ASSETS DETAILS:</h3>
            </div>
        </div>

        <div style="display: table; bottom:0;width:100%; ">
            <table>
                <tr style="width: 30px; color: #FFFFFF;">
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

                        <td style="background-color: #413f28; color: #FFFFFF">{{\App\Helpers\Helper::getCategoryName($asset->asset_type) or 'NULL'}}</td>
                        <td style="background-color: #413f28; color: #FFFFFF;">{{$asset->asset_tag}}</td>
                        <td style="background-color: #413f28; color: #FFFFFF">{{$asset->model->name or 'NULL'}}</td>

                        <td style="background-color: #413f28; color: #FFFFFF;text-align: center;">{{$asset->purchase_cost or 'NULL'}}</td>
                        <td style="background-color: #413f28; color: #FFFFFF;text-align: center;">{{$asset->purchase_date or 'NULL'}}</td>
                        <td style="background-color: #413f28; color: #FFFFFF;text-align: center;">{{$asset->_snipeit_sof or 'NULL'}}</td>
                        <td style="background-color: #413f28; color: #FFFFFF;">{{$asset->_snipeit_donor_name or 'NULL'}}</td>
                        <td style="background-color: #413f28; color: #FFFFFF">{{$asset->serial or 'NULL'}}</td>
                        <td style="background-color: #413f28; color: #FFFFFF"></td>
                        <td style="background-color: #413f28; color: #FFFFFF;">{{$eol}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop