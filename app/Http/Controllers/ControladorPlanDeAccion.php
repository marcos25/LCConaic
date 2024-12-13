<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlanAccion;
use Illuminate\Support\Facades\Auth;
use App\Categoria;
use App\Recomendacion;
use PDF;
use PDFMerger;
use App\Evidencia;


class ControladorPlanDeAccion extends Controller
{

    public function listaPlanes(){
        
        $idCategoria= Auth::user()->categoria->id;//agarro el id de la categoria que tiene el usuario autenticado
        $categoria = Categoria::findOrFail($idCategoria);
        $planes = PlanAccion::where('categoria_id',$idCategoria)->get();//agarro todos los planes que tengan la categoria del usuario
        $recomendaciones = Recomendacion::where('categoria_id', $idCategoria)->get();
        return view('planAccion.inicio',compact('planes','categoria', 'recomendaciones'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //falta mandar la categoria para manejarla en la vista
        //Se agrego parametro $id_recomendacion.
        $rec = $_REQUEST['rec_id'];
        $rec2 = $_REQUEST['rec_idc'];
        $nombre_recomendacion = Recomendacion::findOrFail($rec)->nombre;
        return view('planAccion.crearPlanAccion', compact('rec', 'nombre_recomendacion','rec2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $credentials=$this->validate($request, array(
            'nombrePlan' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/',
            'descripcionPlan'=> 'required|min:20|regex:/^[a-zA-Z][\s\S]*/',
            'fecha_termino' => 'required',
        ));
          $rec2 = $_REQUEST['rec_idc'];
        if($credentials){
            $plan = new PlanAccion();

            $idCategoria= $rec2;
            $categoria = Categoria::findOrFail($idCategoria);
            $plan->nombre = $request->input("nombrePlan");
            $plan->descripcion = $request->input("descripcionPlan");
            $plan->fecha_termino = $request->input("fecha_termino");
            $plan->categoria()->associate($categoria);
            $plan->recomendacion_id = $request->input("rec");
            $plan->criterio = $request->input("criterioHecho");
            $plan->save();
            $recomendacion = Recomendacion::findOrFail($request->input("rec"));
            $recomendacion->planes()->save($plan);
            $recomendacion->save();
            return redirect()->route('categorias.show', $plan->recomendacion->categoria->id);
        }else{
            //Si es falso, se regresa a la misma pagina de registro con los errores que hubo.
            return back()->withInput(request(['nombrePlan']));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanAccion::findOrFail($id);
        $evidencias = $plan->evidencias;
        return view('planAccion.show', compact('plan','evidencias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan= PlanAccion::findOrFail($id);
        return view('planAccion.editar',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $credentials=$this->validate($request, array(
            'nombrePlan' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/',
            'descripcionPlan'=> 'required|min:20|regex:/^[a-zA-Z][\s\S]*/',
            'fecha_termino' => 'required',
            'completado' => 'required',
        ));
         $rec2 = $_REQUEST['rec_idc'];
        
        if($credentials){
            $plan = PlanAccion::findOrFail($id);
            $idCategoria= $rec2;
            $categoria = Categoria::findOrFail($idCategoria);
            
            $plan->nombre = $request->input("nombrePlan");
            $plan->descripcion = $request->input("descripcionPlan");
            $plan->fecha_termino = $request->input("fecha_termino");
            $plan->completado = $request->input("completado");
            $plan->criterio = $request->input("criterioHecho");
            $plan->categoria()->associate($categoria);
            $plan->save();
            
            return redirect()->route('categorias.show', $plan->categoria->id);
        }else{
            return back()->withInput(request(['nombrePlan']));
        }
    }
    /**
     * Funcion que se encarga de actualizar el campo 'completado' en la tabla de planes_de_accion
     */
    public function planCompletado(Request $request,$id){
        $plan = PlanAccion::findOrFail($id);
        if(count($request->input()) > 3){
            $plan->nombre = $request->input("nombrePlan");
            $plan->descripcion = $request->input("descripcionPlan");
            $plan->fecha_termino = $request->input("fecha_termino");
            $plan->criterio = $request->input("criterioHecho");
        }
        $plan->completado = $request->input('completado');
        $plan->save();

        return redirect()->route('categorias.show', $plan->categoria->id);
        //return view('planAccion.show', compact('plan'));
    }

    public function planReporte($id){
        $plan = PlanAccion::findOrFail($id);
        $merger = \PDFMerger::init();

        $pdf = PDF::loadView('planAccion/reporte', ['plan'=>$plan]);
        $output = $pdf->output();
        file_put_contents($plan->nombre .= ".pdf", $output);
        $merger->addPathToPDF( $plan->nombre, 'all', 'P');
        foreach($plan->evidencias as $evidencia){
            if($evidencia->tipo_archivo == "pdf"){
                $merger->addPathToPDF(ltrim($evidencia->archivo_bin, $evidencia->archivo_bin[0]), 'all', 'P'); 
            }
        }
        $merger->merge();
        $merger->save("rpt.pdf");
        $archivo = "rpt.pdf";
        
        return view('planAccion.verReporte', compact('archivo', 'plan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan= PlanAccion::findOrFail($id);
        
        $plan->evidencias()->detach();

        $plan->delete();
        return redirect()->back();
    }
}
 