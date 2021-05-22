<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cab extends Model
{
    use HasFactory;

    //relación uno a uno con el chofer
    public function driver(){
        return $this->hasOne('App\Models\Driver');
    }

    //relación uno a muchos con la corrida
    public function corridas(){
        return $this->hasMany('App\Models\Corrida');
    }
}

/*
ewsto es para cuando accedemos a un registro de taxi, tambien accedemos a su chofer
tambien los podemos hacer del sentido inverso
public function driver(){
    $driver = Driver::where('cab_id', $this->id)->first();
    return $driver;

    o tambien se puede haecer
    retunr $this->hasOne(Driver::class);
}*/