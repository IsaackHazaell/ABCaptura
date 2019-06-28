<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    protected $fillable = ['name','honorary','date','square_meter', 'status'];

/*    public function getFechaConsAttribute() //Accessor
    {
      return Carbon::parse($this->$constructions->date)->format('d-F-Y');
    }*/
}
