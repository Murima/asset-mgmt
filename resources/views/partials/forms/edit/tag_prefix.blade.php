<!-- tag-prefix -->
<div class="form-group {{ $errors->has('category_prefix') ? ' has-error' : '' }}">
    <label for="category_prefix" class="col-md-3 control-label">{{ $translated_name }}</label>
    <div class="col-md-7 col-sm-12{{  (\App\Helpers\Helper::checkIfRequired($item, 'category_prefix')) ? ' required' : '' }}">
        <input class="form-control" type="text" name="category_prefix" id="category_prefix" value="{{ Input::old('category_prefix', $item->category_prefix) }}" />
        {!! $errors->first('category_prefix', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
    </div>
</div>