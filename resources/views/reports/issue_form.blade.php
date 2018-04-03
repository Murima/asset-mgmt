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
            <h2>Personal Issue Form</h2>
        </div>

        <div style="border-style: double; background-color: #FFFFFF">

            <table border="1" style="width: 50%;">
                <tr>
                    <th>Program:</th>
                    <td>Somalia</td>
                    <th>Description:</th>
                    <td>{{$description}}</td>
                </tr>

                <tr>
                    <th>Date:</th>
                    <td>{{$date}}</td>
                    <th>Serial Number:</th>
                    <td style="color: #ca1c1d; font-weight: bold">{{$serial}}</td>
                </tr>
                <tr>
                    <th>Office:</th>
                    <td>{{$office or ''}}</td>
                    <th>Asset tag:</th>
                    <td style="color: #ca1c1d; font-weight: bold">{{$tag}}</td>
                </tr>

            </table>


            <table border="1" style="width: 50%; margin: 10px 0 10px 0;">

                <th>Accessories:</th>
                @foreach($accessories as $accessory)
                    <tr>
                        <td>{{$accessory or ''}}</td>
                    </tr>
                @endforeach

            </table>

            <div >
                <table border="1">

                    <th style="background-color: lightgrey;">Agreement:</th>
                    <tr>
                        <td><p style="font-family: 'Times New Roman'; font-size: 12px;">
                                The Assets  listed belong to Save the Children International.All items MUST to be returned to the Logistics department.<br>
                                In the event of loss or damage, loss or theft the Logistics department MUST be informed <br>
                                Items must NOT be disposed of or transferred to another person without prior authorisation from the  Logistics unit <br>
                            </p>
                        </td>
                    </tr>

                </table>
            </div>

            <div style=" margin:0 auto;">
                <table border="1">

                    <th style="background-color: lightgrey">Terms:</th>
                    <tr>
                        <td><p style="font-family: 'Times New Roman'; font-size: 12px;">
                                I acknowledge receipt of the above mentioned items and understand the terms and conditions stated above.<br>
                                I have been briefed on the use and maintainence of the equipment and confirm that the equipment is in a serviceable condition.<br>
                                I will return the equipment to the logistics department, unless I have been given authorisation to dispose or transfer the equipment.
                            </p>
                        </td>
                    </tr>

                </table>
            </div>
            <h3 style="text-align: center">Fill on issue</h3>

            <div>

                <div>
                    <table border="1" style="width:50%;float: left;">
                        <tr >
                            <th>Issued to:</th>
                            <td>{{$first_name}}</td>
                            <td>{{$last_name}}</td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td>{{$date}}</td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td>{{$user_title}}</td>
                        </tr>
                        <tr>
                            <th>Signature:</th>
                            <td style="height: 50px;"></td>
                        </tr>
                        <tr >

                    </table>
                </div>

                <div >
                    <table border="1" style="width: 50%; float: left;">
                        <tr >
                            <th>Approved by:</th>
                            <td>{{$approver_fname}}</td>
                            <td>{{$approver_lname}}</td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td>{{$date}}</td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td>{{$approver_title}}</td>
                        </tr>
                        <tr>
                            <th>Signature:</th>
                            <td style="height: 50px;"></td>
                        </tr>
                        <tr >

                    </table>
                </div>

            </div>

            <div style="margin-top: 20px;">
                <table border="1" style="width: 50%;">
                    <tr >
                        <th>Issued by:</th>
                        <td>{{$issue_fname}}</td>
                        <td>{{$issue_lname}}</td>
                    </tr>
                    <tr>
                        <th>Date:</th>
                        <td>{{$date}}</td>
                    </tr>
                    <tr>
                        <th>Position:</th>
                        <td>{{$issue_title}}</td>
                    </tr>
                    <tr>
                        <th>Signature:</th>
                        <td style="height: 50px;"></td>
                    </tr>
                    <tr >

                </table>
            </div>


            <br>
            <div style="vertical-align: middle; width: 100%; text-align: center">
                <h3>Fill on return</h3>
                <hr>
            </div>


            <table border="1" style="float: left; width: 50%;">
                <tr style="height: 60px;">
                    <th style="text-align: left">Returned by:</th>
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
                    <th style="text-align: left">Signature:</th>
                    <td style="height: 50px;"></td>
                </tr>
                <tr >

            </table>

            <table border="1" style="width: 50%;">
                <tr style="height: 60px;">
                    <th style="text-align: left">Recieved by:</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align: left;">Date:</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align: left">Position:</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align: left">Signature:</th>
                    <td style="height: 50px;"></td>
                </tr>
                <tr >

            </table>
        </div>
    </div>
@stop