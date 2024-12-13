<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Categoria;
use App\Academico;
use App\Rules\Categoria as AppCategoria;
use App\Recomendacion;
use PDF;
use App\PlanAccion;


class ControladorCategorias extends Controller
{
    public function __construct(){
        $this->middleware('auth');
         $this->middleware('admin', ['except' => ['listas','show','']]);

    }

    /**
     * Funcion que se encarga de desplegar 5 categorias y despues paginarlas en la vista listaCategorias.
     * @return vista con todas las categorias.
     *
     */
    public function index()
    {
        //con la funcion with() encuentro las categorias relacionadas con la tabla academico.
        $categorias = Categoria::with('academico')->paginate(20);
        //regreso la vista con la variable como arreglo
        return view('categorias.listaCategorias')->with(['categorias'=>$categorias]);
    }

      public function listas()
    {
        //con la funcion with() encuentro las categorias relacionadas con la tabla academico.
        $categorias = Categoria::with('academico')->paginate(20);
        //regreso la vista con la variable como arreglo
        return view('categorias.listaCategorias2')->with(['categorias'=>$categorias]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academicos= Academico::all();
        // dd($academicos);
        // $academicoConCategoria = Academico::has('categoria')->get();
        //$academicoSinCategoria = Academico::doesnthave('categoria')->get();

        return view('categorias.crearCategoria',compact('academicos'));
    }
     public function lista()
    {
        $academicos= Academico::all();
        // dd($academicos);
        // $academicoConCategoria = Academico::has('categoria')->get();
        $academicoSinCategoria = Academico::doesnthave('categoria')->get();

        return view('categorias.crearCategoria',compact('academicoSinCategoria'));
    }


    /**
     * Funcion que se encarga de crear el objeto de tipo categoria, valida que los datos ingresados por el usuario
     * sean los correctos,si no, regresa un error a la vista, si la validacion pasa  llena los atributos de ese objeto
     * con los datos que ingresa el usuario y despues lo guarda en la base de datos
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $credentials=$this->validate($request, array(
            'nombreCategoria' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/'.$categoria->id,
            'descripcionCategoria'=> 'required|min:20|regex:/^[a-zA-Z][\s\S]*/',
        ));


        if($credentials){

            $categoria ->nombre= $request->input('nombreCategoria');
            $categoria ->descripcion= $request->input('descripcionCategoria');

            //condiciona que si se envia el formulario sin academicos pongo el atributo academico_id con el valor de null
            if($request->academicoID == 'NULL'){
                $categoria ->academico_id= null;
                $categoria->save();
                return redirect()->route('categorias.index');
            }else{
                $academico = Academico::findOrFail($request->academicoID);
                $categoria -> academico()->associate($academico);
                $categoria->save();
                return redirect()->route('categorias.index');
            }

        }else{
            //Si es falso, se regresa a la misma pagina de registro con los errores que hubo.
            return back()->withInput(request(['nombreCategoria'=>'hehexd']));
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
        $categoria= Categoria::findOrFail($id);
        $recomendaciones = $categoria->recomendaciones;

        $planes = array();
        foreach($recomendaciones as $recomendacion)
            if(count($recomendacion->planes)>0)
            {
                foreach($recomendacion->planes as $plan)
                    array_push($planes, $plan);
            }

        return view('categorias.verCategoriaSeleccionada', compact('categoria','recomendaciones', 'planes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria= Categoria::findOrFail($id);
        $academicos = Academico::all();
        //checa si la categoria tiene un academico o no
        if($categoria->academico == null){
            return view('categorias.editar',compact('categoria','academicos'));
        }else {
            $academicoID= $categoria->academico->id;
            $academicoAsignado= Academico::findOrFail($academicoID); //academico de la categoria a editar
             // $academicos= Academico::all();
            return view('categorias.editar',compact('categoria','academicos','academicoAsignado'));
        }
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
            'nombreCategoria' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/',
            'descripcionCategoria'=> 'required|min:10|regex:/^[a-zA-Z][\s\S]*/',

        ));
        // dd($request->academicoID);
        if($credentials){
            $categoria = Categoria::findOrFail($id);
            $categoria ->nombre= $request->input('nombreCategoria');
            $categoria ->descripcion= $request->input('descripcionCategoria');
            //condiciona que si se envia el formulario sin academicos pongo el atributo academico_id con el valor de null
            if($request->academicoID == 'NULL'){
                $categoria ->academico_id= null;
                $categoria->save();
                return redirect()->route('categorias.index');
            }else{
                $academico = Academico::findOrFail($request->academicoID);
                $categoria -> academico()->associate($academico);
                $categoria->save();
                return redirect()->route('categorias.index');
            }
        }else{
            //Si es falso, se regresa a la misma pagina de registro con los errores que hubo.
            return back()->withInput(request(['nombreCategoria']));
        }
    }

    public function categoriaReporte($id){
        $categoria = Categoria::findOrFail($id);
        $merger = \PDFMerger::init();
        $pdf = PDF::loadView('categorias/reporte', ['categoria'=>$categoria]);
        $output = $pdf->output();
        file_put_contents($categoria->nombre, $output);
        $merger->addPathToPDF($categoria->nombre, 'all', 'P');
        foreach($categoria->recomendaciones as $recomendacion){
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
        }
        $merger->merge();
        $merger->save("mergedpdf.pdf");
        $archivo = "/mergedpdf.pdf";
        return view('categorias.verReporte', compact('archivo', 'categoria'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria= Categoria::findOrFail($id);
        $categoria-> delete();
        return redirect()->route('categorias.index');
    }
}
