<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cab extends Model
{
    use HasFactory;
  
    /**
     * relación uno a uno con el chofer
     *
     * @return void
     */
    public function driver(){
        return $this->hasOne('App\Models\Driver');
    }

    /**
     * relación uno a muchos con la corrida  
     *
     * @return void
     */
    public function corridas(){
        return $this->hasMany('App\Models\Corrida');
    }
}