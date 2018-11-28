<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaSubvencion extends Model
{
    protected $table = 'cuenta_subvencion';

    protected $fillable = [
        
        'idCuenta'
      , 'idSubvencion'
      ,
    ];
}
