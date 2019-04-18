<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capture extends Model
{
    protected $fillable = ['date', 'total', 'iva', 'honorarium', 'voucher', 'folio', 'fund_id', 'construction_id', 'provider_id', 'concept'];
}
