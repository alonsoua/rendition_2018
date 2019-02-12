<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaDocumento extends Model
{
    protected $table = 'cuenta_documento';

    protected $fillable = [
        
        'idCuenta'
      , 'idDocumento'
      ,
    ];
}
