<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable= ['name', 'quantity', 'price'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
