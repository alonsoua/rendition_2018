<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class forma_pago extends Model
{
    protected $table = 'forma_pago';

    protected $fillable = [
        
        'id'
      , 'nombre'
      ,
    ];
}
