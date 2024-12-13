<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Academico extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    protected $table='academicos';
    protected $fillable =['nombre','email','password'];
    protected $hidden = ['password', 'remember_token',];

    //relacion de la tabla academico con la tabla categoria.
    public function categoria(){
        return $this->hasOne(Categoria::class, 'academico_id');
    }
}

