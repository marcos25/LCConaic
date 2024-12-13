<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    //


    protected $table='notificaciones';
    protected $fillable =['nombre','descripcion'];
    public $timestamps = false;

    
}
