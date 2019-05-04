<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $fillable = ['construction_id','provider_id','status','total', 'remaining'];
}
