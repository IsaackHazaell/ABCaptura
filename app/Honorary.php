<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Honorary extends Model
{
    public function Capture()
    {
      return $this->belongsToMany(Capture::class);
    }
}
