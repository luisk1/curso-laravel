<?php

namespace App\Http\Controllers\Seguridad;


//use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Support\Facades\Auth;
//use App\Usuarioprueba;
//use Redirect;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    public function __construct()
   {
        $this->middleware('guest')->except('logout');
    }
  
    public function index(){
        return view('seguridad.inde');
    }
    
   protected function authenticated(Request $request, $user){
     $roles = $user->roles()->get();
     $p = $user->toArray();
     $s =" ";
     $a =json_decode($p['usua_datos']);
       if($roles->isNotEmpty()){
       $user->setSession($roles->toArray());
       session()->put('nombre',$a->{'nombre'} .$s. $a->{'apellido'});
       session()->put('cedula',$p['cedula']);
       session()->put('id',$p['id']);
           }else{
         $this->guard()->logout();
         $request->session()->invalidate();
         return redirect('seguridad/login')->withErrors(['error'=>'este usuario no tiene un rol activo']);
       }
     }
     public function username()
    {
        return 'cedula';
    }
   }
    //public function login(LoginRequest $request)
    //{
     
      //  if(Auth::attempt(['usua_datos.cedula' => $request->usua_datos, 'usua_pass' => $request->usua_pass],false)){
     //       return response()->json($request->usua_datos,200);
       // }
   // }
   // public function logins(LoginRequest $request){
        //$users = Usuarioprueba::where('usua_datos->cedula', $request->usua_datos)->get();
          //      return($users);
        //return response()->json($request->usua_datos,200);
  //      if (Auth::attempt(['usua_datos->cedula' => $request->usua_datos, 'password' => $request->password],false)) {
            //return ($request->password);
            //return Redirect::to('inicio');
   //         return response()->json('Has iniciado sesion',200);
            //return redirect()->intended('admin/gestionarusuario');
            
            //return view('admin.admin.index');
            //return redirect('gestionarorden');
     //  }else{
      //  return response()->json(['errors'=>['login'=>['Los datos que ingresaste son incorrectos']]],422);
     //  }
     //   }
        
          

