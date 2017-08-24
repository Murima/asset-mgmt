<!-- Manufacturer -->
<div class="form-group {{ $errors->has('manufacturer_id') ? ' has-error' : '' }}">
    <label for="manufacturer_id" class="col-md-3 control-label">{{ trans('general.manufacturer') }}</label>
    <div class="col-md-7{{  (\App\Helpers\Helper::checkIfRequired($item, 'manufacturer_id')) ? ' required' : '' }}">
        {{ Form::select('manufacturer_id', $manufacturer_list , Input::old('manufacturer_id', $item->manufacturer_id), array('class'=>'select2', 'style'=>'width:100%')) }}
        {!! $errors->first('manufacturer_id', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
    </div>
    <div class="col-md-1 col-sm-1 text-left">
        <a href='#' data-toggle="modal" data-target="#createModal" data-dependency="model" data-select="model_select_id" class="btn btn-sm btn-default">New</a>
        <span class="mac_spinner" style="padding-left: 10px; color: green; display:none; width: 30px;"><i class="fa fa-spinner fa-spin"></i> </span>
    </div>
</div>

<!-- Modal -->
<div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
                    <div class="control-group">
                        <label for="manufacturer" class="control-label">Manufacturer:</label>
                        <div class="controls">
                            {{ Form::text('manufacturer', null, array('class'=>'span3', 'placeholder'=>'Manufacturer')) }}
                        </div>
                    </div> <!-- /field -->

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>