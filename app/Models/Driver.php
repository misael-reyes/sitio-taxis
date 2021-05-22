<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    //relación uno a uno con taxis (inversa)
    public function cab(){
        return $this->belongsTo('App\Models\Cab');
    }
}

/*
  haremos esto para cuando queremos ver un registro de un chofer, tambien podamos ver que taxi tiene asignado

 public function cab(){
    $cab = Cab::find($this->cab_id);
    o tembien de la sigienye manera
    return $this->belongsTo('App\Models\Cab');
}
*/

