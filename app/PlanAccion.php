<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanAccion extends Model
{
    protected $table='planes_de_acciones';
    public $timestamps = false;

    /**
     * Relacion muchos a muchos de la tabla plan_de_accion con la tabla pivote evidencias_planes
     */
    public function evidencias(){
        return $this->belongsToMany('App\Evidencia','evidencias_planes');
    }
    /**
     * Relacion de la tabla plan de accion con la tabla categorias
     */
    public function categoria(){
        return $this->belongsTo('App\Categoria','categoria_id');
    }

    /**
     * Relacion de la tabla plan de accion con la tabla recomendacion
     */
    public function recomendacion(){
        return $this->belongsTo(Recomendacion::class);
    }
}
