@include('partials.reports.report-header')
<body>
@include('partials.reports.report-navbar')
<main>
    <div class="container-fluid">
        <div style="margin-top: 10px;">


            <div class="row col-md-4 container-fluid" style="float: left">
                <table id="t1" style="margin-bottom: 5px">
                    <tr>
                        <td colspan="2">FROM</td>
                        <td colspan="2">TO</td>
                    </tr>
                    <tr>
                        <td>From (Warehouse Location):</td>
                        <td>{{$origin}}</td>
                        <td>Consignee: </td>
                        <td>{{$cosignee->first_name}}</td>
                    </tr>
                    <tr>
                        <td>Date Raised:</td>
                        <td>{{$date_raised}}</td>
                        <td>Address: </td>
                        <td>{{$cosignee_address}}</td>
                    </tr>
                    <tr>
                        <td>Sender&#39;s Email:</td>
                        <td style="color:deepskyblue;">{{$sender_email}}</td>
                        <td>Phone:</td>
                        <td >{{$cosignee->email}}</td>
                    </tr>
                    <tr>
                        <td>Sender&#39;s Tel No.:</td>
                        <td>{{$sender_number}}</td>
                        <td>Email:</td>
                        <td style="color:deepskyblue;">{{$cosignee->email}}</td>
                    </tr>
                    <tr>
                        <td class="noDisplay"></td>
                        <td class="noDisplay"></td>
                        <td><span class="block">Primary Contact</span>(Name):</td>
                        <td>{{$primary_contact->first_name}} {{$primary_contact->last_name}}</td>
                    </tr>
                    <tr>
                        <td class="noDisplay"></td>
                        <td class="noDisplay"></td>
                        <td><span class="block">Primary</span> Phone/Email:</td>
                        <td>{{$primary_contact->email}}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-4" style="float: right;">
                <table id="t2" style="width: 10px;">
                    <tr>
                        <td rowspan="2">Waybill No</td>
                        <td>{{$waybill_no}}</td>

                    </tr>
                    <tr>
                        <td>WB / OFFICE / YEAR / SEQUENTIAL NO</td>
                    </tr>
                </table>
            </div>


        </div>

        <div class="row container-fluid" style="margin-top: 30px;">
            <div class="col-md-12">
                <table id="t3">
                    <tr>
                        <td colspan="2">
                            TRANSPORT DETAILS
                        </td>
                        <td colspan="2">
                            TRANSPORT TYPE
                        </td>
                        <td colspan=4>MEANS OF TRANSPORT</td>
                        <td colspan="2">DATES OF TRANSPORT</td>
                    </tr>
                    <tr>
                        <td>Transporter Name</td>
                        <td>{{$transporter_name->first_name}} {{$transporter_name->last_name}}</td>
                        <td>Commercial</td>
                        <td class="center">{{Form::checkbox('commercial', 1, $transport_type=='commercial')}}</td>
                        <td>Road</td>
                        <td class="center">{{Form::checkbox('road', 1, $transport_type=='road')}}</td>
                        <td>Sea</td>
                        <td class="center">{{Form::checkbox('sea', 1, $transport_type=='sea')}}</td>
                        <td>Date of Dispatch</td>
                        <td>{{$DOD}}</td>
                    </tr>
                    <tr>
                        <td>Transporter&#39;s Tel no.</td>
                        <td>{{$transporter_number}}</td>
                        <td>Vehicle</td>
                        <td class="center">{{Form::checkbox('vehicle', 1, $means=='vehicle')}}</td>
                        <td>Rail</td>
                        <td class="center">{{Form::checkbox('rail', 1, $means=='rail')}}</td>
                        <td>Hand Carry</td>
                        <td class="center">{{Form::checkbox('hand carry', 1, $means=='hand')}}</td>
                        <td>ETD</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Driver&#39;s Name</td>
                        <td></td>
                        <td>Other</td>
                        <td class="center">{{Form::checkbox('other', 1, $means=='other')}}</td>
                        <td>Air</td>
                        <td class="center">{{Form::checkbox('air', 1, $means=='air')}}</td>
                        <td class="noDisplay"></td>
                        <td class="noDisplay"></td>
                        <td>ETA</td>
                        <td>{{$ETA}}</td>
                    </tr>
                    <tr>
                        <td>Vehicle&#39;s Registration No.</td>
                        <td>{{$vehicle_reg}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row container-fluid" style="margin-top: 30px;">
            <table id="t4">
                <tr>
                    <td>Description</td>
                    <td>Carton No.</td>
                    <td><span class="block">GIK</span> (Y/N)</td>
                    <td>Project Code</td>
                    <td>SOF</td>
                    <td>Procurement Request No.</td>
                    <td>Unit</td>
                    <td>Pack type</td>
                    <td>Quantity</td>
                    <td>Unit Value(Indicated)</td>
                    <td>Total Value(Indicated currency)</td>
                    <td>Total weight</td>
                    <td>Total Volume</td>
                    <td><span class="block">Qty</span>received</td>
                    <td>Remarks</td>
                </tr>
                @foreach ($assets as $asset)
                    <tr>
                        <td>{{ $asset->showAssetName() }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>{{$asset->_snipeit_project_code}}</td>
                        <td>{{$asset->_snipeit_sof}}</td>
                        <td>{{$asset->_snipeit_po_number}}</td>
                        <td>{{$asset->asset_type}}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>{{$asset->purchase_cost }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endforeach

                @for($count = 0; $count<$lines; $count++)
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endfor

                <tr>
                    <td colspan="11" class="align-right">TOTAL WEIGHT (KGS) and Volume (CBM)</td>
                    <td class="center">0</td>
                    <td class="center">0</td>
                </tr>
            </table>

            <table id="t5">
                <tr>
                    <td>MISSING TEXT</td>
                    <td>Name</td>
                    <td>Position</td>
                    <td>Signature</td>
                    <td>Date</td>
                    <td>Condition</td>
                </tr>
                <tr>
                    <td>(Sender)</td>
                    <td>{{$sender->first_name}} {{$sender->last_name}}</td>
                    <td>{{$sender->jobtitle}}</td>
                    <td></td>
                    <td>{{$date}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>(Transporter)</td>
                    <td>{{$transporter_name->first_name}} {{$transporter_name->last_name}}</td>
                    <td>{{$transporter_name->jobtitle}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="margin-bottom: 10px;">
                    <td>(Consignee)</td>
                    <td>{{$cosignee->first_name}} {{$cosignee->last_name}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6">
                        Comments: (Include details on any missing/damaged items received - please be specific and state exact quantities)
                    </td>
                </tr>
                <tr>
                    <td colspan="6"><textarea name="" id="commentSection"></textarea></td>
                </tr>
            </table>
        </div>
    </div>
</main>

@include('partials.reports.report-footer')
</body>
