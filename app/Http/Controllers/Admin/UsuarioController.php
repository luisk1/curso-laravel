<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\usuariorol;
use App\Models\Seguridad\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function guardar(Request $req,$datos,$pas,$ced)
    {        
        $data = new Usuario();
    	$data->cedula = $ced;
    	$data->usua_datos = $datos;
        $data->password = bcrypt($pas);
        $data->email = $req->get('email');
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
        $data = Usuario::find($id);        
        $data->cedula = $req->get('val1');
    	$data->usua_datos = $req->get('val2');
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

