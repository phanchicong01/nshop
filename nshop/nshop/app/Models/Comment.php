<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];//lấy tất cả các cột

    public function product () {
        return $this->belongsTo('App\Models\Product', 'id_product');
    }
    public function user () {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
