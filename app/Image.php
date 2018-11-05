<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['name', 'product_id', 'general'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
