<!-- Capital or non capital -->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
        <label>
            <input type="checkbox" value="0" name="capital" id="capital" class="minimal" {{ Input::old('capital', $item->capital_non_capital) == '1' ? ' checked="checked"' : '' }}> {{ $requestable_text }}
            <a tabindex="0" role="button"  data-toggle="popover" data-placement="right" data-trigger="focus" title="Capital Assets" data-content="{!! $capital_asset_text !!}" style="margin-left: 10px">?</a>
        </label>

    </div>
</div>