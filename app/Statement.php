<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function construction()
    {
        return $this->belongsTo(construction::class);
    }
    protected $fillable = ['construction_id','provider_id','status','total', 'remaining'];
}
