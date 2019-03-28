<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  public function construction()
    {
      return $this->belongsTo(Construction::class);
    }
    protected $fillable = ['name', 'cellphone', 'phonelandline', 'address'];
}
