<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  public function provider()
    {
      return $this->belongsTo(Provider::class);
    }
    //protected $fillable = ['street', 'colony', 'town', 'state'];
}
