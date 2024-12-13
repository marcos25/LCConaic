<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recomendacion;
use Illuminate\Support\Facades\Auth;
use App\Categoria;
use Session;
use App\PlanAccion;
use PDF;
use Illuminate\Support\Facades\URL;


class ControladorRecomendaciones extends Controller
{

    public function __construct(){
        $this->middleware('auth');
       $this->middleware('admin', ['except' => ['show']]);

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
    public function create($idCategoria,$ida)
    {  
        

        $categoria = Categoria::findOrFail($idCategoria);
        
        return view('recomendaciones.create',compact('categoria'));
    
    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$idCategoria)
    {
        //
        $credentials=$this->validate($request, array(
            'nombre' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/',
            'descripcion'=> 'required|min:10',
        ));
        if($credentials){
            $recomendacion = new Recomendacion();
            $categoria = Categoria::findOrFail($idCategoria);
            $recomendacion->nombre = $request->input("nombre");
            $recomendacion->descripcion = $request->input("descripcion");
            $recomendacion->categoria()->associate($categoria);
            $recomendacion->save();
            Session::flash('message_crear','Se ha creado una recomendación con éxito.');
            return redirect()->route('categorias.show', [$idCategoria]);
        }else{
            //Si es falso, se regresa a la misma pagina de registro con los errores que hubo.
            return back()->withInput(request(['nombre']));
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
        $recomendacion = Recomendacion::findOrFail($id);
        $planes = PlanAccion::where('recomendacion_id', $recomendacion->id)->get();
        return view('recomendaciones.show', compact('recomendacion', 'planes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rutaPrevia = url()->previous();
        $recomendacion = Recomendacion::findOrFail($id);
        return view('recomendaciones.edit',compact('recomendacion','rutaPrevia'));
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
        
        $rutaPrevia = $request->rutaPrevia;
        $rutaPrevia = explode("/",$rutaPrevia)[3];
        //
        $credentials=$this->validate($request, array(
            'nombreRec' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/',
            'descripcionRec'=> 'required|min:10',

        ));
        if($credentials){
            $recomendacion = Recomendacion::findOrFail($id);
            $idCategoria= $recomendacion->categoria->id;
            $recomendacion ->nombre= $request->input('nombreRec');
            $recomendacion ->descripcion= $request->input('descripcionRec');
            $recomendacion->save();

            if($rutaPrevia == "recomendacionesAdministrador"){
                return redirect("recomendacionesAdministrador");
            }
            
            Session::flash('message_editar','Se ha editado la recomendación con éxito.');
            return redirect()->route('categorias.show', [$idCategoria]);
        }else{
            return back()->withInput(request(['nombreRec']));
        }
    }

    public function recomendacionReporte($id){
        $recomendacion = Recomendacion::findOrFail($id);
        $merger = \PDFMerger::init();

        $planesCompletados = PlanAccion::where('completado', 1)->where('recomendacion_id', $recomendacion->id)->get();
        $planesProgreso = PlanAccion::where('completado', 0)->where('recomendacion_id', $recomendacion->id)->get();

        $pdf = PDF::loadView('recomendaciones/reporte', ['recomendacion'=>$recomendacion, 'planesCompletados'=>$planesCompletados, 'planesProgreso'=>$planesProgreso]);
        $output = $pdf->output();
        file_put_contents($recomendacion->nombre, $output);
        $merger->addPathToPDF( $recomendacion->nombre , 'all', 'P');
        foreach($recomendacion->planes as $plan){
            $pdf = PDF::loadView('planAccion/reporte', ['plan'=>$plan]);
            $output = $pdf->output();
            file_put_contents($plan->nombre, $output);
            $merger->addPathToPDF( $plan->nombre , 'all', 'P');
            foreach($plan->evidencias as $evidencia){
                if($evidencia->tipo_archivo == "pdf"){
                    $merger->addPathToPDF(ltrim($evidencia->archivo_bin, $evidencia->archivo_bin[0]));
                }
            }
        }
        $merger->merge();
        $merger->save("mergedpdf.pdf");
        $archivo = "/mergedpdf.pdf";
        return view('recomendaciones.verReporte', compact('archivo', 'recomendacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $recomendacion= Recomendacion::findOrFail($id);
      $categoria_id = $recomendacion->categoria->id;
      $recomendacion->planes()->delete(); 
      $recomendacion-> delete();
      Session::flash('message_borrar','Se ha eliminado la recomendación con éxito.');
      return redirect()->route('categorias.show', $categoria_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy2($id)
    {
      $recomendacion= Recomendacion::findOrFail($id);
      $categoria_id = $recomendacion->categoria->id;
      $recomendacion->planes()->delete(); 
      $recomendacion-> delete();
      return redirect()->back();
    }
}
