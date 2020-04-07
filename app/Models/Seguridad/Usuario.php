<?php

namespace App\Models\Seguridad;
use App\Models\Admin\rol;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Session;

class Usuario extends Authenticatable
{
    use Notifiable;
    protected $remember_token = false;
    protected $table = 'usuario';
    protected $fillable = ['cedula','usua_datos','email', 'password'];
    

    public function roles(){
        return $this->belongsToMany(rol::class,'usuario_rol');
    }
    public function setSession($roles){
        if(count($roles) == 1){
            Session::put(
                [
                    'rol_id' => $roles[0]['id'],
                    'rol_nombre' => $roles[0]['nombre']
                
                ] 
            );
        }
    }
}
