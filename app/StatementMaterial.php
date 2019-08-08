<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatementMaterial extends Model
{
    public function construction()
    {
        return $this->belongsTo(construction::class);
    }
    protected $fillable = ['construction_id','name','status','total', 'remaining'];
}
