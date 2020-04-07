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
}
