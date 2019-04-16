<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
  public function construction()
    {
      return $this->belongsTo(Construction::class);
    }
    protected $fillable = ['date','total'];
}
