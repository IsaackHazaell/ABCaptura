<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['name', 'category', 'turn', 'cellphone', 'phonlandline', 'mail', 'company'];

}
