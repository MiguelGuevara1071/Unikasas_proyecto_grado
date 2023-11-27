<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // public function test_user_create()
    // {
    //     $user = User::create([
    //         'primer_nombre' => 'Manuel',
    //         'segundo_nombre' => 'Arturo',
    //         'primer_apellido' => 'Guevara',
    //         'segundo_apellido' => 'Gomez',
    //         'tipo_documento' => 'CC',
    //         'numero_documento' => '1061404206',
    //         'telefono_usuario' => '3213440932',
    //         'email' => 'manuelArturo@gmail.com',
    //         'password' => bcrypt('1061404206'),
    //         'estado_usuario' => 'Activo',
    //         'rol_id' => 1
    //     ]);

    //     $token = ('jdjfhdfjhd');
    //     // // $book = factory(Book::class)->create();

    //     $response = $this->withHeaders(['Authorization' => "Bearer $token"])
    //         ->json('POST', 'usuarios', [
    //             'primer_nombre' => 'Manuel',
    //             'segundo_nombre' => 'Arturo',
    //             'primer_apellido' => 'Guevara',
    //             'segundo_apellido' => 'Gomez',
    //             'tipo_documento' => 'CC',
    //             'numero_documento' => '1061404206',
    //             'telefono_usuario' => '3213440932',
    //             'email' => 'manuelArturo@gmail.com',
    //             'password' => '1061404206',
    //             'estado_usuario' => 'Activo',
    //             'rol_id' => 1
    //         ]);
    //         // dd($response);
    //     $response->assertStatus(201);
    // }

    // public function test_user_get_into()
    // {
    //     $user = create('App\User', [
    //         "email" => "miguelguevara1071@mail.com"
    //     ]);

    //     $this->get('/login')->assertSee('login');
    //     $credentials = [
    //         "email" => "miguelguevara1071@mail.com",
    //         "password" => "1071304206"
    //     ];

    //     $response = $this->post('/login', $credentials);
    //     $response->assertRedirect('/proyectos');
    //     $this->assertCredentials($credentials);
    // }
}
