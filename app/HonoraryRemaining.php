<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HonoraryRemaining extends Model
{
    protected $fillable = ['remaining','construction_id'];

    public function construction()
    {
      return $this->belongsTo('App\construction');
    }
}
