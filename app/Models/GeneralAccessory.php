<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralAccessory extends Model
{
    //
    protected $table = 'general_accessories';
    public $timestamps = false;
    protected $fillable = ['accessory_name'];

    /**
     * General accessory validation rules
     */
    public $rules = array(
        'accessory_name'    => 'required|min:3|max:255',
        'category_id'       => 'required|integer',
    );
}
