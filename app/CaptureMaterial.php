<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaptureMaterial extends Model
{
    protected $guarded = ['id'];

    public function statement_material()
    {
      return $this->belongsTo(StatementMaterial::class);
    }
}
