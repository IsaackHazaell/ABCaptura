<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capture extends Model
{
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }
    public function construction()
    {
        return $this->belongsTo(construction::class);
    }
    protected $fillable = ['date', 'total', 'iva', 'honorarium', 'voucher', 'folio', 'fund_id', 'construction_id', 'provider_id', 'concept'];
}
