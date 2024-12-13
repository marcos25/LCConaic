<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evidencia;
use App\PlanAccion;
use App\Categoria;
use Illuminate\Support\Facades\Storage;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Illuminate\Http\File;
use PDF;


class ControladorEvidencias extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evidencias = Evidencia::all();
        return view('evidencias.lista', compact('evidencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $planesTodos = PlanAccion::all();
        $planes = array();
        for( $i = 0 ; $i < count($planesTodos) ; $i++ )
        {
            if(auth()->user()->id == $planesTodos[$i]->categoria->academico_id){
                array_push($planes, $planesTodos[$i]);
            }
        }
        $planActual = PlanAccion::findOrFail($request->id);
        return view('evidencias.crear', compact('planes', 'planActual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evidencia = new Evidencia();
        $verificados = $this->validate($request, array(
            'nombreEvidencia' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/',
            'archivo' => 'required | mimes:pdf,jpg,jpeg,png,bmp,tiff | max:30000',
            'plan' => 'required'
        ));

        if($verificados)
        {

            $archivo = request()->file('archivo');

            $evidencia->nombre_archivo = $request->input('nombreEvidencia');

            $evidencia->tipo_archivo = $archivo->getClientOriginalExtension();

            $nombreArchivo = $archivo->getClientOriginalName();

            $evidencia->archivo_bin = "/archivos/".$nombreArchivo;
            $plan = PlanAccion::findOrFail($request->input('plan'));

            // el tercer parámetro indica a qué sistema de archivos se subirá. En este caso, es a public_path()
            $archivo->storeAs('archivos/', $nombreArchivo, 'uploads');

            if($evidencia->tipo_archivo != 'pdf'){
                $view = \View::make('pdf', compact('evidencia'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view);
                $output = $pdf->output();
                $evi = pathinfo($evidencia->archivo_bin, PATHINFO_FILENAME);
                $evi = $evi.'.pdf';
                file_put_contents(public_path().'/pdf/'.$evi, $output);
                $ext = pathinfo($evi, PATHINFO_EXTENSION);
                $evidencia->archivo_mod = "/pdf/".$evi;
                $evidencia->tipo_mod = $ext;
            }
            else{
                $pdf = PDFMerger::init();
                $pdf->addPDF(public_path().$evidencia->archivo_bin, 'all');
                $pdf->merge();
                $nombre_evi = pathinfo($evidencia->archivo_bin, PATHINFO_FILENAME);
                $nombre_evi = $nombre_evi.'.pdf';
                $pdf->save(public_path().'/pdf/'.$nombre_evi, "file");
                $evidencia->archivo_mod = "/pdf/".$nombre_evi;
                $exten = pathinfo($evidencia->archivo_bin, PATHINFO_EXTENSION);
                $evidencia->tipo_mod = $exten;
            }

            $evidencia->save();
            $evidencia->planes()->attach($plan);

            return redirect()->route('plan.show', $plan->id);

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
        $evidencia = Evidencia::findOrFail($id);
        return view('evidencias.mostrar', compact('evidencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evidencia = Evidencia::findOrFail($id);
        $planesTodos = PlanAccion::all();

        $planes = array();
        for( $i = 0 ; $i < count($planesTodos) ; $i++ )
        {
            if(auth()->user()->id == $planesTodos[$i]->categoria->academico_id){
                array_push($planes, $planesTodos[$i]);
            }
        }

        $planActual = PlanAccion::findOrFail($evidencia->planes[0]->id);
        return view('evidencias.editar', compact('evidencia','planes', 'planActual'));
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
        $evidencia = Evidencia::findOrFail($id);

        //dd($request->file('archivo'));
        if($request->file('archivo'))
        {

            $verificados = $this->validate($request, array(
                'nombreEvidencia' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/',
                'archivo' => 'required | mimes:pdf,jpg,jpeg,png,bmp,tiff | max:30000'
            ));
        }
        else {

            $verificados = $this->validate($request, array(
                'nombreEvidencia' => 'required|min:5|max:100|regex:/^[a-zA-Z][\s\S]*/',

            ));
        }

        $archivo = request()->file('archivo');

        $evidencia->nombre_archivo = $request->input('nombreEvidencia');

        if($request->hasFile('archivo'))
        {
            $nombreArchivo = $archivo->getClientOriginalName();
            $evidencia->tipo_archivo = $archivo->getClientOriginalExtension();
            $archivo->storeAs('archivos/', $nombreArchivo, 'uploads');
            $evidencia->archivo_bin = "/archivos/".$nombreArchivo;
        }

        $view = \View::make('pdf', compact('evidencia'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $output = $pdf->output();
        $evi = pathinfo($evidencia->archivo_bin, PATHINFO_FILENAME);
        $evi = $evi.'.pdf';
        file_put_contents(public_path().'/pdf/'.$evi, $output);
        $ext = pathinfo($evi, PATHINFO_EXTENSION);
        $evidencia->archivo_mod = "/pdf/".$evi;
        $evidencia->tipo_mod = $ext;

        $plan = PlanAccion::findOrFail($request->input('plan'));
        //dd($id);
        //dd($plan->evidencias[1]->id);
        $estaEnPlanes = false;

        // primero checamos si hay un plan asignado
        if(count($evidencia->planes) > 0){
            for( $i = 0; $i < count($evidencia->planes) ; $i++ )
            {
                if($plan->id == $evidencia->planes[$i]->id)
                {
                    $estaEnPlanes = true;
                    break;
                }
            }
            if(!$estaEnPlanes)
            {
                // primero usamos detach para desasociar con el viejo plan
                $evidencia->planes()->detach($evidencia->planes[0]->id);
                $evidencia->planes()->attach($plan);
            }
        }
        else {
            $evidencia->planes()->attach($plan);
        }

        $evidencia->save();

        return redirect()->route('plan.show', $plan->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evidencia = Evidencia::findOrFail($id);
        $plan = PlanAccion::findOrFail($evidencia->planes[0]->id);
        if(count($evidencia->planes) > 0){
            $evidencia->planes()->detach($evidencia->planes[0]->id);
        }

        $evidencia->delete();
        return redirect()->route('plan.show', $plan->id);
    }
}
