<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatementProviderMaterial extends Model
{
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function statement_material()
    {
        return $this->belongsTo(StatementMaterial::class);
    }
    protected $fillable = ['statement_material_id','provider_id'];
}
