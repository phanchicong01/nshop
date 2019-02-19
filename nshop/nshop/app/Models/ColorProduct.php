<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    protected $table = 'color_products';
    protected $guarded = [];
    public function product () {
        return $this->belongsTo('App\Models\Product', 'id_product');
    }
}
