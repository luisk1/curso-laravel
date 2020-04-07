<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = "cita";
    protected $fillable = ['cita_usu_id','cita_fecha','cita_hora','cita_estado','cita_recibido'];
    protected $guarded = ['id'];
}
