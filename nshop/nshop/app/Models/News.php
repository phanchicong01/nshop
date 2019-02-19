<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = [];
    public function user () {
        return $this->belongsTo('App\Models\Admin', 'id_user');
    }
}
