@extends('layouts.default-excel')
@section('content')
    <div style="display: block; width: 100%; background-color: red; height: 90px;">
        <div style="background-color: black; height: 90px; width: 360px; float: left;">
            <img src="{{ public_path('uploads/'.$snipeSettings->logo)}}" style="height: 70px;">
        </div>

        <h2 style="text-align: right;
            text-decoration: underline;
            text-decoration-style:double;
            font-family: 'Times New Roman',serif;
        font-weight: bold;
        font-size: 35px;
        color: white; float: right;">WayBill</h2>

    </div>

    <div style="display: block; width: 100%;">
        <style type="text/css">
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg .tg-2i5d{background-color:#ffce93;border-color:inherit;vertical-align:top}
            .tg .tg-us36{border-color:inherit;vertical-align:top}
        </style>
        <div style="width: 70%; float: left;">
            <table class="tg" style="table-layout: fixed;
    width: 485px;border-collapse:collapse;border-spacing:0;float: left;">
                <colgroup>
                    <col style="width: 150px">
                    <col style="width: 310px">
                </colgroup>
                <tr>
                    <th class="tg-2i5d">From</th>
                    <th class="tg-us36"></th>
                </tr>
                <tr>
                    <td class="tg-2i5d">Date</td>
                    <td class="tg-us36"></td>
                </tr>
                <tr>
                    <td class="tg-2i5d">Senders Email<br></td>
                    <td class="tg-us36"></td>
                </tr>
                <tr>
                    <td class="tg-2i5d">Senders Mobile No<br></td>
                    <td class="tg-us36"></td>
                </tr>
            </table>

            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg .tg-2i5d{background-color:#ffce93;border-color:inherit;vertical-align:top}
                .tg .tg-us36{border-color:inherit;vertical-align:top}
                .tg .tg-gr78{background-color:#ffce93;vertical-align:top}
                .tg .tg-yw4l{vertical-align:top}
            </style>
            <table class="tg" style="table-layout: fixed; width: 377px">
                <colgroup>
                    <col style="width: 151px">
                    <col style="width: 226px">
                </colgroup>
                <tr>
                    <th class="tg-2i5d">Cosignee<br></th>
                    <th class="tg-us36">Murima Elvis</th>
                </tr>
                <tr>
                    <td class="tg-2i5d">Address<br></td>
                    <td class="tg-us36"></td>
                </tr>
                <tr>
                    <td class="tg-2i5d">Phone<br></td>
                    <td class="tg-us36"></td>
                </tr>
                <tr>
                    <td class="tg-2i5d">Email<br></td>
                    <td class="tg-us36"></td>
                </tr>
                <tr>
                    <td class="tg-gr78">Primary contact (Name)<br></td>
                    <td class="tg-yw4l"></td>
                </tr>
                <tr>
                    <td class="tg-gr78">Office</td>
                    <td class="tg-yw4l"></td>
                </tr>
            </table>

        </div>

        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg .tg-t9wu{font-family:Arial, Helvetica, sans-serif !important;;border-color:inherit;text-align:center}
            .tg .tg-l711{border-color:inherit}
            .tg .tg-yw4l{vertical-align:top}
            .tg .tg-t9wu{background-color: #ff7636
            }
        </style>
        <div style="width: 30%; float: right;">
            <table class="tg" style="table-layout: fixed; width: 243px;float: right;">
                <colgroup>
                    <col style="width: 80px">
                    <col style="width: 137px">
                </colgroup>
                <tr>
                    <th class="tg-t9wu" rowspan="2"><br>Waybill<br>   No<br></th>
                    <th class="tg-l711"></th>
                </tr>
                <tr>
                    <td class="tg-yw4l"></td>
                </tr>
            </table>
        </div>

    </div>


    <div>
        <br>
    </div>
    <div style="display: block; width: 100%;">
        <div style="float: left;">
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg .tg-uhkr{background-color:#ffce93}
            </style>
            <table class="tg" style="table-layout: fixed; width: 343px">
                <colgroup>
                    <col style="width: 150px">
                    <col style="width: 310px">
                </colgroup>
                <tr>
                    <th class="tg-uhkr">Transporter's Name<br></th>
                    <th class="tg-031e"></th>
                </tr>
                <tr>
                    <td class="tg-uhkr">Transporters No<br></td>
                    <td class="tg-031e"></td>
                </tr>
                <tr>
                    <td class="tg-uhkr">Driver's Name<br></td>
                    <td class="tg-031e"></td>
                </tr>
                <tr>
                    <td class="tg-uhkr">Registration No<br></td>
                    <td class="tg-031e"></td>
                </tr>
            </table>
        </div>

        <div style="height: 40px;">
            <div style="float: left;">
                <style type="text/css">
                    .tg  {border-collapse:collapse;border-spacing:0;}
                    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                    .tg .tg-uhkr{background-color:#ffce93}
                    .tg .tg-efv9{font-family:Arial, Helvetica, sans-serif !important;}
                </style>
                <th>Transport Type</th>
                <table class="tg" style="undefined;table-layout: fixed; width: 133px">
                    <colgroup>
                        <col style="width: 85px">
                        <col style="width: 48px">
                    </colgroup>
                    <tr>
                        <th class="tg-uhkr">Commercial</th>
                        <th class="tg-efv9"></th>
                    </tr>
                </table>
            </div>

            <div style="float: left;">
                <style type="text/css">
                    .tg  {border-collapse:collapse;border-spacing:0;}
                    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                    .tg .tg-uhkr{background-color:#ffce93}
                    .tg .tg-efv9{font-family:Arial, Helvetica, sans-serif !important;}
                </style>
                <th>Means of transport</th>
                <table class="tg" style="undefined;table-layout: fixed; width: 133px">
                    <colgroup>
                        <col style="width: 85px">
                        <col style="width: 48px">
                    </colgroup>
                    <tr>
                        <th class="tg-uhkr">Air<br></th>
                        <th class="tg-efv9"></th>
                    </tr>
                </table>
            </div>
        </div>


        <div style="float: right;">
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                .tg .tg-uhkr{background-color:#ffce93}
                .tg .tg-efv9{font-family:Arial, Helvetica, sans-serif !important;}
                .tg .tg-gr78{background-color:#ffce93;vertical-align:top}
                .tg .tg-yw4l{vertical-align:top}
            </style>
            <th>Dates of transport</th>
            <table class="tg" style="undefined;table-layout: fixed; width: 231px">
                <colgroup>
                    <col style="width: 126px">
                    <col style="width: 105px">
                </colgroup>
                <tr>
                    <th class="tg-uhkr">Date of dispatch<br></th>
                    <th class="tg-efv9"></th>
                </tr>
                <tr>
                    <td class="tg-gr78">ETD</td>
                    <td class="tg-yw4l"></td>
                </tr>
                <tr>
                    <td class="tg-gr78">ETA</td>
                    <td class="tg-yw4l"></td>
                </tr>
            </table>
        </div>
    </div>


    <div style="text-decoration: underline;
    text-decoration-style:dotted;
    font-family: 'Times New Roman',serif;
    font-weight: bold;
    color: #03010b; vertical-align: middle">
        <h3>ASSETS DETAILS:</h3>
    </div>

@stop