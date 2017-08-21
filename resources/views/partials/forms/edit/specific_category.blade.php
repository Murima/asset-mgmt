<!-- Name -->
<div class="form-group {{ $errors->has('specific_category') ? ' has-error' : '' }}">
    <label for="specific_category" class="col-md-3 control-label">{{ $translated_name }}</label>
    <div class="col-md-7 col-sm-12{{  (\App\Helpers\Helper::checkIfRequired($item, 'specific_category')) ? ' required' : '' }}">
        <input class="form-control" type="text" name="specific_category" id="specific_category" value="{{ Input::old('specific_category', $item->specific_category) }}" />
        {!! $errors->first('name', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
    </div>
</div>