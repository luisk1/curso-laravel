<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\usuariorol;
use App\Models\Seguridad\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Validacionusuario;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return view('admin.usuario.usuario');
         
    }
    public function indexes()
    {
            return view('admin.usuario.crear');       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verificar(Request $req)
    {
        $data = Usuario::where('id',session()->get('id'))->get();
        return($data);
    }
    public function verificasesion()
    {
        return(session()->get('nombre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardardos(Request $request){
        $dat = $request->get('usua_datos');
        
       
    }

    public function guardar(Validacionusuario $req)
    {     
        $dat = $req->get('usua_datos');   
        $data = new Usuario();
    	$data->cedula = $req->get('cedula');
        $data->usua_datos = \json_encode($req->get('usua_datos'));
        $data->email = $dat['email'];
        $data->password = bcrypt($req->get('password'));        
        $data->save();
        $p = $data->toArray();
        if(Auth::check()){
            $dat = new usuariorol();
            $dat->rol_id = 2;
            $dat->usuario_id = $p['id'];
            $dat->estado = 1;
            $dat->save();
            return $data;
        }else{
            $dat = new usuariorol();
            $dat->rol_id = 3;
            $dat->usuario_id = $p['id'];
            $dat->estado = 1;
            $dat->save();
            return $data;
        }
        //return response()->json('errors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buscar($id,$pa)
    {
        $ide = bcryp($pa);
        //dd($ide);
        $data = Usuario::where('usua_pass',$ide)->get();
        //$data = Usuarioprueba::where('usua_pass', '$ide')->get();        
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $req,$id)
    {
        $dat = $req->get('usua_datos');
        $data = Usuario::find($id);        
        $data->cedula = $req->get('cedula');
        $data->usua_datos = $req->get('usua_datos');
        $data->email = $dat['email'];
    	$data->save();
    	return $data;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

