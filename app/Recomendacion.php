<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    protected $table = 'recomendaciones';
    protected $fillable = ['nombre','descripcion'];
    public $timestamps = false;

    /**
     * Relacion de la tabla recomendacion con la tabla categoria
     */
    public function categoria(){
        return $this->belongsTo(Categoria::class,'categoria_id');
    }

    /**
     * Relacion 1 a muchos de la tabla recomendaciones con la tabla planes
     */
    public function planes(){
        return $this->hasMany(PlanAccion::class);
    }
}
