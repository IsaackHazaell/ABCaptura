<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitPrice extends Model
{
    protected $fillable = ['name', 'year', 'cost', 'unit'];
}
