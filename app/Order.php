<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'account_username', 'account_password', 'create_profile', 'billing_street', 'billing_city',
        'billing_zip', 'billing_country', 'customer_id', 'product_id'];

    protected $hidden = ['password'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }
}
