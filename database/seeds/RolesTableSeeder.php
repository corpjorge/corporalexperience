<?php

use Illuminate\Database\Seeder;
use App\Model\General\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dato = new Roles();
        $dato->descripcion="Super Admin";      
        $dato->save();

        $dato = new Roles();
        $dato->descripcion="Administrador";       
        $dato->save();

        $dato = new Roles();
        $dato->descripcion="Gerente";    
        $dato->save();       

        $dato = new Roles();
        $dato->descripcion="Director";       
        $dato->save();

        $dato = new Roles();
        $dato->descripcion="Jefe";      
        $dato->save();

        $dato = new Roles();
        $dato->descripcion="Coordinador";      
        $dato->save();

        $dato = new Roles();
        $dato->descripcion="Profesor";      
        $dato->save();

        $dato = new Roles();
        $dato->descripcion="Auxiliar";       
        $dato->save();

        $dato = new Roles();
        $dato->descripcion="Asistente";        
        $dato->save(); 
        
        $dato = new Roles();
        $dato->descripcion="Cliente";        
        $dato->save();

    }
}
