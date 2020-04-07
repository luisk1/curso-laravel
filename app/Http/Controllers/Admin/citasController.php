<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Cita;
use App\citaxorden;
use App\Ordenmodel;
use Illuminate\Http\Request;

class citasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cita.crear');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrar()
    {
        $users = Ordenmodel::select('ordencompra.*')->leftJoin('citaxorden', 'ordencompra.orden', '=', 'citaxorden.citaorden')->whereNull('citaxorden.citaorden')->get(); 
        $dat = $users->toArray();
        return $dat;
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarordencita(Request $req){
        $data = new citaxorden();
        $data->citax_id = $req['val1'];
        $data->citaorden = $req['val2'];
        $data->save();
        return $data;
    }

    public function guardar(Request $req)
    { 
        try{
            $data = new Cita();
        $data->cita_usu_id = session()->get('id');
        $data->cita_fecha = $req['val1'];
        $data->cita_hora = $req['val2'];
        $data->cita_estado = 'asignada';
        $data->save();
        return [
            'respuesta'=>'Cita creada',
            'resp' => $data
        ];    
        
        }
        catch (\Exception $e) {
            //return response()->json(['respuesta'=>'Cita rechazada'],400);
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buscarfecha(Request $req,$fe)
    {//dd(session()->all());
        $data = Cita::where('cita_fecha',$fe)->select('cita_hora')->get();
        return($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
