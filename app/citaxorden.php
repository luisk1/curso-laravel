<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class citaxorden extends Model
{
    protected $table = "citaxorden";
    protected $fillable = ['citax_id','citaorden_id'];
    protected $guarded = ['id'];
}
