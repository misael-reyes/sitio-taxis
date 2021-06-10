<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    /**
     * relación uno a uno con taxis (inversa)   
     *
     * @return void
     */
    public function cab(){
        return $this->belongsTo('App\Models\Cab');
    }
}