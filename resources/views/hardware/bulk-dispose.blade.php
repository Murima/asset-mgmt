@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('admin/hardware/form.bulk_dispose') }}

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

            <p>{{ trans('admin/hardware/form.bulk_dispose_help') }}</p>

            <form class="form-horizontal" method="post" action="{{ route('hardware/bulkdispose') }}" autocomplete="off" role="form">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="color: red">{{ trans('admin/hardware/form.bulk_dispose_warn', ['asset_count' => count($assets)]) }}</h3>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="box-body col-md-8 col-md-offset-2">

                        <div class="form-group">
                            <label for="reason" class="col-md-3 control-label">{{ trans('admin/hardware/form.reason') }}</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="reason" id="reason" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="disposal_methods" class="col-md-3 control-label">{{ trans('admin/hardware/form.means') }}</label>
                            <div class="col-md-7 col-sm-12">

                                <select name="disposal_methods" class="select2" style="width: 100%;">
                                    <option value="scrapping">Scrapping</option>
                                    <option value="sale">Sale</option>
                                    <option value="donation">Donation</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requested_by" class="col-md-3 control-label">{{ trans('admin/hardware/form.requested_by') }}</label>
                            <div class="col-md-7 col-sm-12">
                                {{ Form::select('requested_by', $users_list , array('class'=>'select2', 'id'=>'requested_by', 'style'=>'width:100%')) }}

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="budget_holder" class="col-md-3 control-label">{{ trans('admin/hardware/form.budget_holder') }}</label>
                            <div class="col-md-7 col-sm-12">
                                {{ Form::select('budget_holder', $users_list , array('class'=>'select2', 'id'=>'budget_holder', 'style'=>'width:100%')) }}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country_director" class="col-md-3 control-label">{{ trans('admin/hardware/form.cd') }}</label>
                            <div class="col-md-7 col-sm-12">
                                {{ Form::select('country_director', $users_list , array('class'=>'select2', 'id'=>'country_director', 'style'=>'width:100%')) }}

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
                        <button type="submit" class="btn btn-success" id="submit-button"><i class="fa fa-check icon-white"></i> {{ trans('general.dispose') }}</button>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </form>


        </div>
    </div>
@stop
