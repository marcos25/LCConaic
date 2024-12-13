<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $table='evidencias';
    protected $fillable =['nombre_archivo','tipo_archivo','archivo_bin'];
    public $timestamps = false;

    /**
     * relacion muchos a muchos de la tabla evidencias con la tabla pivote evidencias_planes
     */
    public function planes(){
        return $this->belongsToMany('App\PlanAccion','evidencias_planes');
    }
}
