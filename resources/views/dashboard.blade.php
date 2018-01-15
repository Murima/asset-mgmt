@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('general.dashboard') }}
    @parent
@stop


{{-- Page content --}}
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/morris.css') }}">
    <div class="row">

        <!-- panel -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ number_format(\App\Models\Asset::assetcount()) }}</h3>
                    <p>{{ trans('general.total_assets') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-barcode"></i>
                </div>
                @can('assets.view')
                    <a href="{{ route('hardware') }}" class="small-box-footer">{{ trans('general.moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{ number_format(\App\Models\License::assetcount()) }}</h3>
                    <p>{{ trans('general.total_licenses') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-floppy-o"></i>
                </div>
                @can('licenses.view')
                    <a href="{{ route('licenses') }}" class="small-box-footer">{{ trans('general.moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3> {{ number_format(\App\Models\Accessory::count()) }}</h3>
                    <p>{{ trans('general.total_accessories') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-keyboard-o"></i>
                </div>
                @can('accessories.view')
                    <a href="{{ route('accessories') }}" class="small-box-footer">{{ trans('general.moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div><!-- ./col -->

        {{--<div class="col-lg-3 col-xs-6">
        @can('consumables.view')

            <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3> {{ number_format(\App\Models\Consumable::count()) }}</h3>
                        <p>{{ trans('general.total_consumables') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-tint"></i>
                    </div>
                    <a href="{{ route('consumables') }}" class="small-box-footer">{{ trans('general.moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            @endcan

        </div><!-- ./col -->--}}

        <div class="col-lg-3 col-xs-6">
        @can('assets.view')

            <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3> {{ \App\Models\Asset::getTotalCost() }}</h3>
                        <p>{{ trans('general.total_usd') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    @can('assets.view')
                        <a href="{{ route('hardware') }}" class="small-box-footer">{{ trans('general.moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
                    @endcan
                </div>
            @endcan

        </div><!-- ./col -->

    </div>

    <!-- recent activity -->
    <div class="row">
        <div class="col-md-9">
            @if (Auth::user()->hasAccess('superuser'))

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('general.recent_activity') }}</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ route('reports/activity') }}"><i class="fa fa-ellipsis-h"></i></a>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table
                                            class="table table-striped"
                                            name="activityReport"
                                            id="table"
                                            data-url="{{route('api.activity.list', ['limit' => 20]) }}">
                                        <thead>
                                        <tr>
                                            <th data-field="icon" style="width: 40px;" class="hidden-xs"></th>
                                            <th class="col-sm-2" data-field="created_at">{{ trans('general.date') }}</th>
                                            <th class="col-sm-2" data-field="admin">{{ trans('general.admin') }}</th>
                                            <th class="col-sm-2" data-field="action_type">{{ trans('general.action') }}</th>
                                            <th class="col-sm-4" data-field="item">{{ trans('general.item') }}</th>
                                            <th class="col-sm-2" data-field="target">To</th>
                                        </tr>
                                        </thead>

                                    </table>
                                </div><!-- /.responsive -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->
                </div><!-- /.box -->
        </div>
        <div class="col-md-3">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('general.assets') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart-responsive">
                                <canvas id="statusPieChart" height="150"></canvas>
                            </div>
                            <!-- ./chart-responsive -->
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    @elseif (Auth::user()->hasAccess('admin'))
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('general.assets') }}</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-responsive">
                                    <canvas id="statusPieChart" height="250"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.box -->
            </div>

            <!-- For the piechart-->
            <div class="col-md-6 float-right">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('general.assets_by_cat') }}</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-responsive">
                                    <canvas id="categoryPieChart" height="250"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>

    @endif




@section('moar_scripts')
    <script src="{{ asset('assets/js/plugins/chartjs/Chart.min.js') }}"></script>
    <script>


        var pieChartCanvas = $("#statusPieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var ctx = document.getElementById("statusPieChart");


        $.get('{{  route('api.statuslabels.assets') }}', function (data) {
            console.log('status',data);
            var myPieChart = new Chart(ctx,{

                type: 'doughnut',
                data: data,
                options: pieOptions
            });

            $("#statusPieChart").click(
                function(evt){
                    var activePoints = myPieChart.getElementAtEvent(evt);
                    var clickedElementindex = activePoints[0]["_index"];
                    //get specific label by index
                    var status = myPieChart.data.labels[clickedElementindex];
                    console.log(status);

                    switch (status){ //TODO this is so wrong im cryiiiing
                        case "Ready to Allocate":
                            window.location= "{{ URL::to('hardware?status=RTD') }}";
                            break;
                        case "In Stock":
                            window.location= "{{ URL::to('hardware?status=Archived') }}";
                            break;
                        case "Damaged":
                            window.location= "{{ URL::to('hardware?status=Damaged') }}";
                            break;
                        case "Disposable":
                            window.location= "{{ URL::to('hardware?status=Disposable') }}";
                            break;
                        case "Allocated":
                            window.location= "{{ URL::to('hardware?status=Deployed') }}";
                            break;

                    }
                }
            );
            // document.getElementById('my-doughnut-legend').innerHTML = myPieChart.generateLegend();
        });


        var pieCategoryCanvas = $("#categoryPieChart").get(0).getContext("2d");
        var catPieChart = new Chart(pieCategoryCanvas);
        var ctx1 = document.getElementById("categoryPieChart");


        $.get('{{route('api.categories.assetscategory')}}', function (data) {
            console.log("pie category",data);
            var myPieChart = new Chart(ctx1, {
                type: 'pie',
                data: data,
                options: pieOptions
            });
        });


    </script>

    <script src="{{ asset('assets/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/mobile/bootstrap-table-mobile.js') }}"></script>
    <script type="text/javascript">
        $('#table').bootstrapTable({
            classes: 'table table-responsive table-no-bordered',
            undefinedText: '',
            iconsPrefix: 'fa',
            showRefresh: false,
            search: false,
            pagination: false,
            sidePagination: 'server',
            sortable: false,
            showMultiSort: false,
            cookie: false,
            mobileResponsive: true,
        });

    </script>
@stop


@stop
