@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('admin/hardware/form.bulk_transfer') }}

    @parent
@stop
@section('header_right')
    <a href="{{ URL::previous() }}" class="btn btn-primary pull-right">
        {{ trans('general.back') }}</a>
@stop

{{-- Page content --}}

@section('content')
    <div class="row">


        <!-- left column -->
        <div class="col-md-12">

            <p>{{ trans('admin/hardware/form.bulk_transfer_help') }}</p>

            <form class="form-horizontal" method="post" action="{{route('hardware/bulktransfer')}}" autocomplete="off" role="form" id="transfer_form">
                <div class="box box-default">
                    {{--<div class="box-header with-border">
                        <h3 class="box-title" style="color: red">{{ trans('admin/hardware/form.bulk_dispose_warn', ['asset_count' => count($assets)]) }}</h3>
                    </div>--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="box-body col-md-8 col-md-offset-2">

                        {{-- origin warehouse --}}
                        <div class="form-group" {{ $errors->has('origin') ? ' has-error' : '' }}>
                            <label for="origin" class="col-md-3 control-label">{{ trans('admin/hardware/form.origin') }}</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="origin" id="origin" value="{{$origin}}" required readonly/>
                            </div>
                        </div>

                        {{--senders number--}}
                        <div class="form-group" {{ $errors->has('sender_number') ? ' has-error' : '' }}>
                            <label for="sender_number" class="col-md-3 control-label">{{ trans('admin/hardware/form.sender_number') }}</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="sender_number" id="sender_number" value="{{Input::old('sender_number')}}" required/>
                                {!! $errors->first('sender_number', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        {{--cosignee--}}
                        <div class="form-group" {{ $errors->has('cosignee') ? ' has-error' : '' }}>
                            <label for="cosignee" class="col-md-3 control-label">{{ trans('admin/hardware/form.cosignee') }}</label>
                            <div class="col-md-7 col-sm-12">
                                {{ Form::select('cosignee', $all_users , array('class'=>'select2', 'id'=>'cosignee', 'style'=>'width:100%'),['required']) }}
                                {!! $errors->first('cosignee', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        {{--cosignee_address--}}
                        <div class="form-group" {{ $errors->has('cosignee_address') ? ' has-error' : '' }}>
                            <label for="cosignee_address" class="col-md-3 control-label">{{ trans('admin/hardware/form.cosignee_address') }}</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="cosignee_address" id="cosignee_address" value="" required/>
                                {!! $errors->first('cosignee_address', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>


                        {{--primary contact--}}
                        <div class="form-group" {{ $errors->has('primary_contact') ? ' has-error' : '' }}>
                            <label for="primary_contact" class="col-md-3 control-label">{{ trans('admin/hardware/form.primary_contact') }}</label>
                            <div class="col-md-7 col-sm-12">
                                {{ Form::select('primary_contact', $all_users , array('class'=>'select2', 'id'=>'primary_contact', 'style'=>'width:100%'), ['required']) }}

                            </div>
                        </div>

                        {{--primary_phone--}}
                        <div class="form-group" {{ $errors->has('primary_number') ? ' has-error' : '' }}>
                            <label for="primary_number" class="col-md-3 control-label">{{ trans('admin/hardware/form.primary_phone') }}</label>

                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="primary_number" id="primary_number" value="" required/>
                                {!! $errors->first('primary_number', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        {{--transporters name--}}
                        <div class="form-group" {{ $errors->has('transporter_name') ? ' has-error' : '' }}>
                            <label for="transporter_name" class="col-md-3 control-label">{{ trans('admin/hardware/form.transporter_name') }}</label>
                            <div class="col-md-7 col-sm-12">
                                {{ Form::select('transporter_name', $all_users , array('class'=>'select2', 'id'=>'primary_contact', 'style'=>'width:100%'), ['required']) }}

                            </div>
                        </div>

                        {{--transporters number--}}
                        <div class="form-group" {{ $errors->has('transporter_number') ? ' has-error' : '' }}>
                            <label for="transporter_number" class="col-md-3 control-label">{{ trans('admin/hardware/form.transporter_number') }}</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="transporter_number" id="transporter_number" value="" required/>
                                {!! $errors->first('transporter_number', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        {{--vehicle registration no--}}
                        <div class="form-group">
                            <label for="vehicle_reg" class="col-md-3 control-label">{{ trans('admin/hardware/form.vehicle_registration') }}</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="vehicle_reg" id="vehicle_reg" value="" />
                                {!! $errors->first('vehicle_reg', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        {{--Date of dispatch--}}
                        <div class="form-group {{ $errors->has('DOD') ? ' has-error' : '' }}">
                            <label for="DOD" class="col-md-3 control-label">{{ trans('admin/hardware/form.date_of_dispatch') }}</label>
                            <div class="input-group col-md-7 col-sm-12">
                                <input type="text" class="datepicker form-control" data-date-format="yyyy-mm-dd" placeholder="{{ trans('general.select_date') }}" name="DOD" id="DOD" value="" required>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                {!! $errors->first('DOD', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        {{--ETA--}}
                        <div class="form-group {{ $errors->has('ETA') ? ' has-error' : '' }}">
                            <label for="ETA" class="col-md-3 control-label">{{ trans('admin/hardware/form.date_of_arrival') }}</label>
                            <div class="input-group col-md-7 col-sm-12">
                                <input type="text" class="datepicker form-control" data-date-format="yyyy-mm-dd" placeholder="{{ trans('general.select_date') }}" name="ETA" id="ETA" value="" required>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                {!! $errors->first('ETA', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        {{--transport type--}}
                        <div class="panel panel-default" style="margin-left: 25%;width: 60%;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Transport type</h3>
                            </div>
                            <div class="panel-body">

                                <div class="form-group" style="columns: 3 3em;padding: 10px;">
                                    <label for="commercial">Commercial</label>
                                    {{Form::radio('transport_type[]', 'commercial')}}

                                    <label for="commercial">Vehicle</label>
                                    {{Form::radio('transport_type[]', 'vehicle')}}

                                    <label for="commercial">Other</label>
                                    {{Form::radio('transport_type[]', 'other')}}
                                </div>

                            </div>
                        </div>

                        {{--means of transport--}}
                        <div class="panel panel-default" style="margin-left: 25%; width: 60%;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Means of transport</h3>
                            </div>
                            <div class="panel-body">

                                <div class="form-group" style="columns: 3 3em; padding: 10px;">
                                    <label for="commercial">Road</label>
                                    {{Form::radio('means[]', 'road')}}

                                    <label for="commercial">Air</label>
                                    {{Form::radio('means[]','air')}}

                                    <label for="commercial">Rail</label>
                                    {{Form::radio('means[]','rail')}}

                                    <label for="commercial">Hand carry</label>
                                    {{Form::radio('means[]','hand')}}

                                    <label for="commercial">Sea</label>
                                    {{Form::radio('means[]','sea')}}
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="box-body">

                        <table class="table table-striped table-condensed">
                            <thead>
                            <tr>
                                <td></td>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Category</td>
                                <td>Location</td>
                                <td>Purchase Cost</td>
                                <td>Assigned To</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($assets as $asset)
                                <tr>
                                    <td><input type="checkbox" name="bulk_edit[]" value="{{ $asset->id }}" checked="checked"></td>
                                    <td>{{ $asset->id }}</td>
                                    <td>{{ $asset->showAssetName() }}</td>
                                    <td>{{$asset->asset_type}}</td>
                                    <td>
                                        @if ($asset->assetloc)
                                            {{ $asset->assetloc->name }}
                                        @endif
                                    </td>
                                    <td>{{$asset->purchase_cost }}</td>
                                    <td>
                                        @if ($asset->assigneduser)
                                            {{ $asset->assigneduser->fullName() }} ({{ $asset->assigneduser->username }})
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>


                    </div><!-- /.box-body -->
                    <div class="box-footer text-right">
                        <a class="btn btn-link" href="{{ URL::previous() }}" method="post" enctype="multipart/form-data">{{ trans('button.cancel') }}</a>
                        <button type="submit" class="btn btn-success" id="submit-button"><i class="fa fa-check icon-white"></i> {{ trans('general.transfer') }}</button>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </form>


        </div>
    </div>
@stop

@section('moar_scripts')
    <script src="{{asset('assets/js/plugins/validator/jquery.validation.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#transfer_form').validate({ // initialize the plugin
                errorClass: "alert-msg",

                transporter_name:{
                    letterswithbasicpunc: true
                }
            });
        });
    </script>
@stop
