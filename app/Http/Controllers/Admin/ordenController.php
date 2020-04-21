<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ordenmodel;
use Illuminate\Http\Request;


class ordenController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ordencompra.crear');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $req)
    {
        $dat = Ordenmodel::where('orden',$req['val1'])->get();
        if($dat->isNotEmpty()){
            return response()->json(['respuesta'=>'OC ya existe, favor ingrese otro numero de OC'],400);
        }else{
            $data = new Ordenmodel();
    	$data->orden = $req['val1'];
    	$data->orden_nombreproveedor = $req['val2'];
    	$data->save();
        return response()->json(['respuesta'=>'OC creada'],200);
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
        $data = Usuarioprueba::where('usua_pass',$ide)->get();
        //$data = Usuarioprueba::where('usua_pass', '$ide')->get();        
        return $data;
    }


    public function mostrar(Request $req)
    {      
        $data = Ordenmodel::orderby('orden')->paginate(5);      
    	return [
            'pagination'=> [
                'total' => $data->total(),
                'pagina_actual' => $data->currentPage(),
                'por_pagina' => $data->perPage(),
                'ultima_pagina' => $data->lastPage(),
                'desde' => $data->firstItem(),
                'hasta' => $data->lastPage(),
            ],
            'x'=>$data
        ];
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $req,$id)
    {
        //dd($orden_id);
        //$data = Ordenmodel::orderby('orden_id')->get();
        $data = Ordenmodel::find($id);
        $data->orden = $req->get('val1');
        $data->orden_nombreproveedor = $req->get('val2');
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
    public function eliminar(Request $req, $orden)
    {
        //dd($orden);
        $data = Ordenmodel::find($orden)->delete();
    }
}
