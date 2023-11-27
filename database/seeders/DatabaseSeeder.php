<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Privilegio;
use App\Models\Rol;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Privilegio::create([
            'nombre_privilegio' => 'Consultar proyectos'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Dirigir proyectos'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Administrar proyectos'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Consultar usuarios'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Administrar usuarios'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Consultar roles'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Administrar roles'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Consultar cotizaciones'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Administrar cotizaciones'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Consultar eventos'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Administrar eventos'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Consultar productos'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Administrar productos'
        ]);

        Privilegio::create([
            'nombre_privilegio' => 'Consultar auditoria'
        ]);

        Rol::create([
            'nombre_rol' => 'Administrador',
        ]);

        Rol::create([
            'nombre_rol' => 'Ventas',
        ]);

        Rol::create([
            'nombre_rol' => 'Cliente',
        ]);

        User::create([
            'primer_nombre' => 'Yeisson',
            'segundo_nombre' => 'Estiven',
            'primer_apellido' => 'Ortiz',
            'segundo_apellido' => 'Torres',
            'tipo_documento' => 'CC',
            'numero_documento' => '1003614209',
            'telefono_usuario' => '3005311110',
            'email' => 'ortizyeison2183@gmail.com',
            'password' => bcrypt('1003614209'),
            'estado_usuario' => 'Activo',
            'rol_id' => 1,
        ]);

        $privilegios = Privilegio::all();
        $rol = Rol::find(1);
        foreach ($privilegios as $privilegio) {
            \App\Models\RolPrivilegio::create([
                'rol_id' => $rol->id,
                'privilegio_id' => $privilegio->id,
            ]);
        }
        User::create([
            'primer_nombre' => 'Miguel',
            'segundo_nombre' => 'Angel',
            'primer_apellido' => 'Guevara',
            'segundo_apellido' => 'Rodriguez',
            'tipo_documento' => 'CC',
            'numero_documento' => '1071304206',
            'telefono_usuario' => '3213440932',
            'email' => 'miguelguevara1071@gmail.com',
            'password' => bcrypt('1071304206'),
            'estado_usuario' => 'Activo',
            'rol_id' => 1,
        ]);

        \App\Models\Producto::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Etapa::factory(6)->create();
        \App\Models\Actividad::factory(10)->create();
        \App\Models\Proyecto::factory(40)->create();
        \App\Models\ProyectoEtapa::factory(10)->create();
        \App\Models\Cotizacion::factory(10)->create();
        \App\Models\ActividadEtapa::factory(10)->create();
        \App\Models\Evento::factory(10)->create();

    }
}
