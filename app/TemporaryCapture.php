<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporaryCapture extends Model
{
    protected $fillable = ['date', 'total', 'iva', 'honorarium', 'voucher', 'folio', 'fund_id', 'construction_id', 'statement_material_id', 'concept'];
}
