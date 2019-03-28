<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['year', 'price', 'month', 'product_id', 'unity_id'];
}
