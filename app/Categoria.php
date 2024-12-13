<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categorias';
    protected $fillable =['nombre','descripcion'];
    public $timestamps = false;
    /**
     * Relacion de la tabla categoria con la tabla academico
     */
    public function academico(){
        return $this->belongsTo(Academico::class);
    }
    /**
     * Relacion 1 a muchos de la tabla categoria con la tabla planes
     */
    public function planes(){
        return $this->hasMany(PlanAccion::class);
    }

    /**
     * Relacion 1 a muchos de la tabla categoria con la tabla recomendaciones
     */
    public function recomendaciones(){
        return $this->hasMany(Recomendacion::class);
    }
}
