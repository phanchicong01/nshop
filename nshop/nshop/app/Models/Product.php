<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];
    public function cate () {
        return $this->belongsTo('App\Models\Category', 'id_cate');
    }
    public function user () {
        return $this->belongsTo('App\Models\Admin', 'id_user');
    }
    public function comment () {
        return $this->hasMany('App\Models\Comment');
    }
    public function image () {
        return $this->hasMany('App\Models\ImageProduct');
    }
}
