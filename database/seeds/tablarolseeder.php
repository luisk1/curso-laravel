<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class tablarolseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'administrador',
            'usuario',
            'auxiliar'
        ];
        foreach($roles as $key => $value){
            DB::table('rol')->insert([
                'nombre' => $value,
                //'created_at' => Carbon::now()->format('Y-d-m H:i:s')
             ]);
        }
        
    }
}
