<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'confirmed', 'seller_id'];

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function images_except_general()
    {
        return $this->images()->where('general', '=', 0);
    }

    public function general_image()
    {
        return $this->images()->where('general', '=', 1)->limit(1);
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }
}
