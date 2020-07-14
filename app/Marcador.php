<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcador extends Model
{
    //
    protected $table = 'marcadores';
    protected $fillable = array('titulo_marcador', 'descripcion_marcador', 'latitud_marcador', 'longitud_marcador');

}
