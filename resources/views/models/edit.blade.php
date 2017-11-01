@extends('layouts/edit-form', [
'createText' => trans('admin/models/table.create') ,
'updateText' => trans('admin/models/table.update'),
'helpTitle' => trans('admin/models/general.about_models_title'),
'helpText' => trans('admin/models/general.about_models_text')
])

{{-- Page content --}}
@section('inputFields')

    {{--
        @include ('partials.forms.edit.category')
    --}}
    <!-- Category -->
    <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
        <label for="category_id" class="col-md-3 control-label">{{ trans('general.category') }}</label>
        <div class="col-md-7 col-sm-12{{  (\App\Helpers\Helper::checkIfRequired($item, 'category_id')) ? ' required' : '' }}">
            {{ Form::select('category_id', $category_list , Input::old('category_id', $item->category_id), array('class'=>'select2', 'style'=>'width:100%')) }}
            {!! $errors->first('category_id', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
        </div>
    </div>
    @include('partials.forms.edit.specific_category',['translated_name' => trans('admin/models/table.specific_category')])
    @include ('partials.forms.edit.name', ['translated_name' => trans('admin/models/table.name')])
    {{--
        @include ('partials.forms.edit.manufacturer')
    --}}
    <!-- Manufacturer -->
    <div class="form-group {{ $errors->has('manufacturer_id') ? ' has-error' : '' }}">
        <label for="manufacturer_id" class="col-md-3 control-label">{{ trans('general.manufacturer') }}</label>
        <div class="col-md-7{{  (\App\Helpers\Helper::checkIfRequired($item, 'manufacturer_id')) ? ' required' : '' }}">
            {{ Form::select('manufacturer_id', $manufacturer_list , Input::old('manufacturer_id', $item->manufacturer_id), array('class'=>'select2', 'style'=>'width:100%')) }}
            {!! $errors->first('manufacturer_id', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
        </div>
        <div class="col-md-1 col-sm-1 text-left">
            <a href='#' data-toggle="modal" data-target="#createModal" data-dependency="manufacturer" class="btn btn-sm btn-default">New</a>
            <span class="mac_spinner" style="padding-left: 10px; color: green; display:none; width: 30px;"><i class="fa fa-spinner fa-spin"></i> </span>
        </div>
    </div>

    @include ('partials.forms.edit.model_number')
    @include ('partials.forms.edit.depreciation')

    <!-- EOL -->

    <div class="form-group {{ $errors->has('eol') ? ' has-error' : '' }}">
        <label for="eol" class="col-md-3 control-label">{{ trans('general.eol') }}</label>
        <div class="col-md-2">
            <div class="input-group">
                <input class="col-md-1 form-control" type="text" name="eol" id="eol" value="{{ Input::old('eol', isset($item->eol)) ? $item->eol : ''  }}" />
                <span class="input-group-addon">
                {{ trans('general.months') }}
            </span>
            </div>
        </div>
        <div class="col-md-9 col-md-offset-3">
            {!! $errors->first('eol', '<span class="alert-msg"><br><i class="fa fa-times"></i> :message</span>') !!}
        </div>
    </div>

    <!-- Custom Fieldset -->
    <div class="form-group {{ $errors->has('custom_fieldset') ? ' has-error' : '' }}">
        <label for="custom_fieldset" class="col-md-3 control-label">{{ trans('admin/models/general.fieldset') }}</label>
        <div class="col-md-7">
            {{ Form::select('custom_fieldset', \App\Helpers\Helper::customFieldsetList(),Input::old('custom_fieldset', $item->fieldset_id), array('class'=>'select2', 'style'=>'width:350px')) }}
            {!! $errors->first('custom_fieldset', '<span class="alert-msg"><br><i class="fa fa-times"></i> :message</span>') !!}
        </div>
    </div>

    @include ('partials.forms.edit.notes')
    @include ('partials.forms.edit.requestable', ['requestable_text' => trans('admin/models/general.requestable')])

    <!-- Image -->
    @if ($item->image)
        <div class="form-group {{ $errors->has('image_delete') ? 'has-error' : '' }}">
            <label class="col-md-3 control-label" for="image_delete">{{ trans('general.image_delete') }}</label>
            <div class="col-md-5">
                {{ Form::checkbox('image_delete') }}
                <img src="{{ config('app.url') }}/uploads/models/{{ $item->image }}" />
                {!! $errors->first('image_delete', '<span class="alert-msg"><br>:message</span>') !!}
            </div>
        </div>
    @endif

    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
        <label class="col-md-3 control-label" for="image">{{ trans('general.image_upload') }}</label>
        <div class="col-md-5">
            {{ Form::file('image') }}
            {!! $errors->first('image', '<span class="alert-msg"><br>:message</span>') !!}
        </div>
    </div>

@stop
@section('moar_scripts')
    <script>
        $(function() {

            $('#category_id').change(function () {
                $('#specific_category').hide();

            });
        });

        function removeFields() {
        }

    </script>
@stop