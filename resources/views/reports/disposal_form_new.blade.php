@include('partials.reports.report-header')
<body>
@include('partials.reports.report-navbar')
<main>
    <div class="container">
        <div class="row" style="margin-top: 20px;" id="secondForm">

            <div class="page">
                <table id="t6" class="no-bottom">
                    <tr>
                        <td rowspan="3" class="dark rotate"><div><span>LOGISTICS</span></div></td>
                        <td>Name of the requestor</td>
                        <td>{{$requester->first_name}}, {{$requester->last_name}}</td>
                        <td>Position</td>
                        <td>{{$requester->jobtitle}}</td>
                    </tr>
                    <tr>
                        <td>Email Address</td>
                        <td style="color: deepskyblue;">{{$requester->email}}</td>
                        <td>Date</td>
                        <td>{{$date}}</td>
                    </tr>
                    <tr>
                        <td>Office Location</td>
                        <td>{{$office}}</td>
                        <td>Signature</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td rowspan="17" class="dark no-bottom rotate"><div><span>FINANCE TO COMPLETE</span></div></td>
                        <td colspan="2">Agresso transaction no:</td>
                        <td colspan="2"><input type="text"></td>

                    </tr>
                    <tr>
                        <td colspan="4" class="dark">DISPOSAL METHOD</td>
                    </tr>
                    <tr>
                        <td colspan="1">
                            <table id="t10">
                                <tr>
                                    <td style="width: 40%;" class="no-top no-left" >Sale</td>
                                    <td class="center no-top">{{Form::checkbox('donate',1,$disposal_method[0]=='sale')}}</td>
                                    <td style="width: 40%;" class="no-top">Donate</td>
                                    <td class="no-right center no-top">{{Form::checkbox('Donate',1,$disposal_method[0]=='donation')}}</td>
                                </tr>
                                <tr>
                                    <td class="no-left">Transfer</td>
                                    <td class="center"><input type="checkbox"></td>
                                    <td>Scrapping</td>
                                    <td class="no-right center">{{Form::checkbox('donate',1,$disposal_method[0]=='scrapping')}}</td>
                                </tr>
                                <tr>
                                    <td class="no-left">Other</td>
                                    <td class="center"><input type="checkbox"></td>
                                    <td>Other</td>
                                    <td class="no-right center">{{Form::checkbox('donate',1,$disposal_method[0]=='other')}}</td>
                                </tr>
                                <tr>
                                    <td class="no-left">Lost</td>
                                    <td class="center"><input type="checkbox"></td>
                                    <td>Tender</td>
                                    <td class="no-right center">{{Form::checkbox('donate',1,$disposal_method[0]=='tender')}}</td>
                                </tr>
                                <tr>
                                    <td class="no-left no-bottom"><span class="block">Returned</span> to donor </td>
                                    <td class="center no-bottom">{{Form::checkbox('donate',1,$disposal_method[0]=='to_donor')}}</td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="3" style="padding:0; position: relative;"><textarea name="" id="" cols="30" rows="4" style="height: 100%; width: 100%; position: absolute; top: 0; left: 0; bottom: 0; right: 0;"></textarea></td>
                    </tr>
                    <tr>
                        <td>Date Invoice Paid</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td>Acquisition cost</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td>Accumulated depreciation</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td>Net book value</td>
                        <td><input type="text"></td>
                    </tr>
                    <!--
                                        <tr>
                                            <td>dd</td>
                                            <td><input type="text"></td>
                                        </tr>
                    -->
                    <tr>
                        <td colspan="5">
                            <div class="first" style="float: left; width: 30%; padding: 5px 0; padding-left: 5px;">
                                <div style="display: inline-block;"><span class="block">Was the asset grant</span>funded ?</div>
                                <div style="display: inline-block; margin-top: 6px;">
                                    <div style="border: 2px solid black; border-right: none;padding: 7px;float: left; margin-left: 20px;">YES</div>
                                    <div style="border: 2px solid black;padding: 7px;display: inline-block;float: right;">NO</div>
                                </div>
                            </div>

                            <div class="second" style="float: left;width: 30%; padding: 5px 0;margin-top: 4px;">
                                <div style="display: inline-block">
                                    <span class="block">Has reminder approval</span>
                                    <span class="block">been gained ?</span>
                                    <!--                                    <span class="block"></span>-->
                                </div>
                                <div style="display: inline-block">
                                    <div style="border: 2px solid black; border-right: none; padding: 7px;float: left; margin-left: 5px;">YES</div>
                                    <div style="border: 2px solid black;border-left: none;padding: 7px;display: inline-block;float: right;">N/A</div>
                                    <div style="border: 2px solid black;padding: 7px;display: inline-block;float: right;">NO</div>
                                </div>
                            </div>

                            <div class="third" style="float: left; width: 30%; padding: 5px;margin-top: 4px;">
                                <div style="display: inline-block">
                                    <span class="block">Has donor approval</span>
                                    <span class="block">been gained ?</span>
                                </div>
                                <div style="display: inline-block">
                                    <div style="border: 2px solid black; border-right: none;padding: 7px;float: left; margin-left: 5px;">YES</div>
                                    <div style="border: 2px solid black;border-left: none;padding: 7px;display: inline-block;float: right;">N/A</div>
                                    <div style="border: 2px solid black;padding: 7px;display: inline-block;float: right;">NO</div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="1" width="25%">Note any relevant donor/member/legal disposal guidelines</td>
                        <td colspan="3"><input type="text"></td>
                    </tr>

                    <tr>
                        <td colspan="5" class="dark">AUTHORISATION</td>
                    </tr>
                    <tr>
                        <td colspan="5">Authorization is required from the Country Director and the regional Finance Director if above the Country Director&#39;s SOD limit</td>
                    </tr>
                    <tr>
                        <td rowspan="2">
                            <span class="block">Country Director.</span>
                            <span class="block">Authorised by (Name</span>
                            <span class="block">and Position</span>
                        </td>
                        <td rowspan="2">{{$country_director->first_name}}, {{$country_director->last_name}}</td>
                        <td>Date</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td>Signature</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td rowspan="2">
                            <span class="block">Reagional Finance Director.</span>
                            <span class="block">Authorised by (Name</span>
                            <span class="block">and Position</span>
                        </td>
                        <td rowspan="2"><input type="text"></td>
                        <td>Date</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td>Signature</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="no-bottom">Once complete, a copy of this form should could be given to the Asset focal point in Logistics to file with the Asset ID form.</td>
                    </tr>

                    <tr>
                        <td colspan="10" class="dark"></td>
                    </tr>

                </table>
                <div class="page-number">
                    @include('partials.reports.report-footer')
                </div>

            </div>

            <div class="page">
                <table id="t7" class="no-bottom">
                    <tr>
                        <td colspan="5" class="dark">Asset Details</td>
                    </tr>
                    <tr style="font-family: 'Times New Roman',serif; text-decoration-color: #0c0c0c">
                        <td style="padding-left: 2px;">Asset tag  </td>
                        <td>Asset description</td>
                        <td>Asset Category</td>
                        <td>Project code</td>
                        <td>Capital/Non Capital</td>
                        <td>Puchase cost</td>
                        <td><span class="block">SOF </span></td>
                        <td>Serial.</td>
                        <td>Other No.</td>
                        <td>Donor name</td>
                        <td>EOL</td>
                        <td><span class="block">Reason for disposal</span>(continue over the page if necessary)</td>
                    </tr>
                    @foreach($assets as $asset)
                        <tr style="background-color: #ffae5f;">
                            <td>{{$asset->asset_tag}}</td>
                            <td>{{$asset->model->name or ''}}</td>
                            <td>{{\App\Helpers\Helper::getCategoryName($asset->asset_type) or 'NULL'}}</td>
                            <td>{{$asset->_snipeit_project_code}}</td>
                            <td>{{$asset->capital_non_capital}}</td>
                            <td>{{$asset->purchase_cost or ''}}</td>
                            <td>{{$asset->_snipeit_sof or 'NULL'}}</td>
                            <td>{{$asset->serial or 'NULL'}}</td>
                            <td>{{$asset->purchase_date or 'NULL'}}</td>
                            <td>{{$asset->_snipeit_donor_name or 'NULL'}}</td>
                            <td>{{$eol}}</td>
                            <td>{{$reason}}</td>

                        </tr>
                    @endforeach
                </table>
                <table id="t8" style="margin-top:20px;">
                    <tr>
                        <td rowspan="3" class="dark rotate"><div><span>LOGISTICS</span></div></td>
                        <td rowspan="3">Asset Registrar and Asset ID form updated with disposal details</td>
                        <td>Name</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>{{$date}}</td>
                    </tr>
                    <tr>
                        <td>Signature</td>
                        <td><input type="text"></td>
                    </tr>
                </table>
                <div class="page-number">
                    @include('partials.reports.report-footer')
                </div>

            </div>

        </div>
    </div>
</main>

</body>

</html>
