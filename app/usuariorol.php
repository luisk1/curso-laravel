<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuariorol extends Model
{
    protected $table = "usuario_rol";
    protected $fillable = ['usuario_id','estado'];
    public $timestamps = false;
    protected $guarded = ['rol_id'];
}
