<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academico;
use App\Categoria;

class ControladorAcademicos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $academicos = Academico::orderBy('id')->paginate(9);
        //dd($academicos);
        $categorias = Categoria::all();
        return view('academicos.mostrarAcademicos', compact('academicos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $academico = new Academico();
        $credentials = $request->validate([
            'nombre' => 'required|max:30',
            'email'=> 'required|email|unique:academicos,email',
            'password' => 'required|min:3|confirmed'/*,
            'categoria' => 'required',*/
        ]);

        if($credentials){
            $academico->nombre = $request ->input('nombre');
            $academico->email = $request-> input('email');
            $academico->password = bcrypt(request('password'));
            $academico->remember_token = "_token";
            $academico->save();

            /*
            if($request->categoria != 'NULL'){
                $categoria = Categoria::findOrFail($request->categoria);
                //$categoria->academico_id = $academico->id;
                $academico->categoria()->save($categoria);
                //$categoria->save();
            }
            //dd($categoria);
            */
            return redirect()->route('academicos.index');
        }

        return back()->withInput(request(['categoria']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Academico $academico){
        $categorias = Categoria::all();
        return view('academicos.editarAcademico', compact('academico', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Academico $academico){

        $credentials = $request->validate([
            'nombre' => 'required|max:30',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
            'categoria' => 'required',
        ]);


        if($credentials){
            $academico->nombre = $request->input('nombre');
            if($academico->email != $request->input('email')) $academico->email = $request-> input('email');
            if($request->password == "knhdl +w-") $academico->password = $academico->password;
            else $academico->password = bcrypt(request('password'));
            $academico->save();

            if($request->categoria == "NULL") return redirect()->route('academicos.index');

            $categoria_antigua = Categoria::where('academico_id', $academico->id)->get()->last();
            if(!$categoria_antigua){
                $categoria = Categoria::findOrFail($request->categoria);

                $academico->categoria()->save($categoria);

                return redirect()->route('academicos.index');
            }
            $categoria_antigua = Categoria::findOrFail($categoria_antigua)->last();

            $categoria_antigua->academico_id = NULL;
            $categoria_antigua->save();

            $categoria = Categoria::findOrFail($request->categoria);

            //$academico->categoria()->dissociate();
            $academico->categoria()->save($categoria);


            return redirect()->route('academicos.index');
        }

        return back()->withInput(request(['categoria']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academico $academico){
        $categoria_antigua = Categoria::where('academico_id', $academico->id)->get()->last();
        if($categoria_antigua){
            $categoria_antigua = Categoria::findOrFail($categoria_antigua)->last();
            $categoria_antigua->academico_id = NULL;
            //dd($categoria_antigua);
            $categoria_antigua->save();
        }
        //dd($categoria_antigua);
        //dd($categoria_antigua);
        $academico->delete();
        return redirect()->route('academicos.index');
    }

    public function editPerfil(){
        $academico_id = auth()->user()->id;
        $academico = Academico::find($academico_id);
        return view('academicos.editarPerfil', compact('academico'));
    }

    public function updatePerfil(Request $request, Academico $academico){
        //dd(Crypt);
        $credentials = $request->validate([
            'nombre' => 'required|max:30',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed'
        ]);

        if($credentials){
            $academico->nombre = $request->input('nombre');
            if($academico->email != $request->input('email')) $academico->email = $request-> input('email');
            if($request->password == "knhdl +w-") $academico->password = $academico->password;
            else $academico->password = bcrypt(request('password'));
            $academico->save();
            return redirect()->route('home');
        }
        return back()->withInput(request(['nombre']));
    }
}
