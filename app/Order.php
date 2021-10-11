<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
