<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ano extends Model
{
    protected $table = 'anos';

    protected $fillable = [
        
        'id'      
      , 'ano'
      , 'estado'      
      ,
    ];
}
