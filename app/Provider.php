<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['name', 'category', 'turn', 'cellphone', 'phonlandline', 'mail', 'company', 'rfc'];


    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function statement_material()
    {
        return $this->hasMany('App\StatementMaterial');
    }

}
