<!--Accessories checkbox-->
<div class="form-group">
       {{-- <label for="accessory" class="form-group">{{ trans('admin/hardware/form.accessories') }}</label>--}}

        <div class="col-sm-offset-3 col-sm-10">

        <label class="checkbox-inline">
                <input type="checkbox" name="accessory[]" >{{trans('admin/hardware/form.mouse')}}
        </label>
        <label class="checkbox-inline ">
                <input type="checkbox" name="accessory[]" >{{trans('admin/hardware/form.keyboard')}}
        </label>
        <label class="checkbox-inline ">
                <input type="checkbox" name="accessory[]" >{{trans('admin/hardware/form.docking_station')}}
        </label>
        <label class="checkbox-inline">
                <input type="checkbox" name="accessory[]" >{{trans('admin/hardware/form.charger')}}
        </label>
        <label class="checkbox-inline">
                <input type="checkbox" name="accessory[]" >{{trans('admin/hardware/form.backpack')}}
        </label>
        <label class="checkbox-inline">
                <input type="checkbox" name="accessory[]" >{{trans('admin/hardware/form.security_lock')}}
        </label>

        </div>
</div>