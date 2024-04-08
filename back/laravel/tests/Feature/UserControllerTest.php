<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba para iniciar sesión.
     */
    public function test_login()
    {
        $password = 'password123';
        $user = User::factory()->create(['password' => Hash::make($password)]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Prueba para registrar un nuevo usuario.
     */
    public function test_register()
    {
        $userData = User::factory()->make()->toArray();
        $userData['password_confirmation'] = $userData['password'] = 'password123';
        $userData['surnames'] = 'Apellido'; // Asegúrate de proporcionar un valor adecuado para 'surnames'

        $response = $this->post('/api/register', $userData);

        $response->assertStatus(200);
    }

    /**
     * Prueba para cerrar sesión.
     */
    public function test_logout()
    {
        $user = User::factory()->create();
        // Crear un token de acceso personal para el usuario
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/logout');

        $response->assertStatus(200);
    }

}
