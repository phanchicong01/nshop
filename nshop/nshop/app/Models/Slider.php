<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $guarded = [];
    public function user () {
        return $this->belongsTo('App\Models\Admin', 'id_user');
    }
}
