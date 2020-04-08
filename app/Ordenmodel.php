<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenmodel extends Model
{
    protected $table = "ordencompra";
    protected $fillable = ['orden_nombreproveedor'];
    protected $primaryKey = 'orden';
}
