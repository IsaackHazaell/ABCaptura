<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    protected $fillable = ['name','honorary','date','square_meter', 'status'];
}
