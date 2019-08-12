<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatementMaterial extends Model
{
    public function construction()
    {
        return $this->belongsTo(construction::class);
    }
    public function providers()
    {
        return $this->hasManyThrough(
            'App\provider',
            'App\StatementProviderMaterial',
            'statement_material_id', // Foreign key on StatementProviderMaterial table...
            'id', // Foreign key on provider table...
            'id', // Local key on statement_material table...
            'provider_id' // Local key on StatementProviderMaterial table...
        );
    }

    
    protected $fillable = ['construction_id','name','status','total', 'remaining'];
}
