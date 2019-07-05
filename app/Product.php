<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['concept', 'description', 'provider_id'];

    public function Price()
    {
      return $this->belongsToMany(Price::class);
    }
}
