<?php

namespace App\Http\Controllers\Auth;

use App\Academico;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Academico::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function store(Request $request){
        $academico = new Academico();
        //dd($request);
        $request->validate([
            'nombre' => 'required|min:4|max:30',
            'email'=> 'required|email|unique:academicos,email',
            'password' => 'required|min:3|confirmed'
        ]);
        
        //dd($request);

        
            $academico->nombre = $request ->input('nombre');
            $academico->email = $request-> input('email');
            $academico->password = bcrypt(request('password'));

            $academico->remember_token = "_token";
            $academico->save();
            
            return redirect('login');
       
       
        //return back()->withErrors(['email' => 'Los datos no son validos'])->withInput(request(['email']));
    }
}
