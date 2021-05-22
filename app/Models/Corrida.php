<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corrida extends Model
{
    use HasFactory;

    //relación uno a muchos con taxi (inversa)
    public function cab(){
        return $this->belongsTo('App\Models\Cab');
    }
}
