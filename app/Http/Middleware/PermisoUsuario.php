<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use App\Categoria;
use App\Academico;

class PermisoUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $academico_id = auth()->user()->id;
        $admin = Academico::find($academico_id);
        $academico_categoria_id = Categoria::where('academico_id', $academico_id)->get()->last();
        //dd($admin->privilegio);
        if(!$academico_categoria_id && $admin->privilegio != 1  ){
            //dd("1");
            Auth::logout();
            Session::flash('message','No se te ha asignado una categoría. Por favor comunícate con el coordinador');
            return redirect('login');
        }

        return $next($request);
    }
}
