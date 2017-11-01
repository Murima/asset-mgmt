<!-- Accessories checkbox -->
<div id="acc_label" class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
        <label>
            <input type="checkbox" name="accessories" id="accessories"  > {{ $accessories_text }}
            {{--
                        <input type="checkbox" name="accessories" id="accessories" class="minimal" > {{ $accessories_text }}
            --}}
            <a tabindex="0" role="button"  data-toggle="popover" data-placement="right" data-trigger="focus" title="Accessories" data-content="{!! $accessories_help_text !!}" style="margin-left: 10px">?</a>
        </label>

    </div>
</div>