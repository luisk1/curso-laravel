<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Cita;
use App\citaxorden;
use App\Ordenmodel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ordencitaController extends Controller
{
    public function index()
    {
        return view('cita.ordencita');
    }
    public function mostrarcita()
    {
        $date = Carbon::now();
        $id = session()->get('id');
        $date = $date->format('yy-m-d');
        $citas = Cita::where('cita_fecha','>',$date)
                    ->where('cita_usu_id',$id)->get();
        $dat = $citas->toArray();
        return $dat;
    }
    public function mostrarcitaasignada()
    {
        $citas = Cita::where('cita_estado','asignada')->get();
        return $citas;
    }
    public function mostrarcitaatendida()
    {
        $citas = Cita::where('cita_estado','atendiendo')->get();
        return $citas;
    }
    public function cargarcitaasignada()
    {
        return view('cita.atendercita');
    }
    public function atender(Request $request )
    {
        $date = Carbon::now();
        $date = $date->format('yy-m-d h:i:s');
        $data = Cita::find($request->get('id'));        
        $data->cita_estado = 'atendiendo';
        $data->cita_recibido = $date;
    	$data->save();
    	return $data;
    }
    public function terminar(Request $request )
    {
        $data = Cita::find($request->get('id'));        
        $data->cita_estado = 'atendida';
        $data->save();
    	return $data;
    }
}
