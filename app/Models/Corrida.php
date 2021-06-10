<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase Corrida
 * 
 * Nos servirá para poder manipular la tabla corridas en la base
 * de datos, ya que como su nombre lo indica, es un modelo
 */
class Corrida extends Model
{
    use HasFactory;
 
    /**
     * relación uno a muchos con taxi (inversa) 
     *
     * @return void
     */
    public function cab(){
        return $this->belongsTo('App\Models\Cab');
    }
}
