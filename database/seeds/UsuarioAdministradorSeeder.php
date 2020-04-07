<?php

use Illuminate\Database\Seeder;

class UsuarioAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('usuario')->insert([
            'cedula' => '123',
            'usua_datos' => '{"email":"l@gmail.com","cedula":"123","nombre":"luis","apellido":"luna"}',
            'email' => 'krlos_lu@hotmail.com',
            'password' => bcrypt('123')
        ]);

        DB::table('usuario')->insert([
            'cedula' => '12',
            'usua_datos' => '{"email":"user@gmail.com","cedula":"8809","nombre":"juna","apellido":"lopez"}',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12')
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => '1',
            'usuario_id' => '1',
            'estado' => 1
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => '2',
            'usuario_id' => '2',
            'estado' => 1   
        ]);
    }
}
