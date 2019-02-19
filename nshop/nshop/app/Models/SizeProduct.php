<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeProduct extends Model
{
    protected $table = 'size_products';
    protected $guarded = [];
    public function product () {
        return $this->belongsTo('App\Models\Product', 'id_product');
    }
}
