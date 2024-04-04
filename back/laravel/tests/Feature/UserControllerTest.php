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

        $response = $this->post('/api/register', $userData);

        $response->assertStatus(200);
    }

    /**
     * Prueba para cerrar sesión.
     */
    public function test_logout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/logout');

        $response->assertStatus(200);
    }

    /**
     * Prueba para obtener todos los usuarios.
     */
    public function test_get_all_users()
    {
        User::factory()->count(3)->create();

        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    /**
     * Prueba para obtener un usuario específico.
     */
    public function test_get_specific_user()
    {
        $user = User::factory()->create();

        $response = $this->get("/api/users/{$user->id}");

        $response->assertStatus(200);
    }

    /**
     * Prueba para actualizar un usuario.
     */
    public function test_update_user()
    {
        $user = User::factory()->create();

        $response = $this->put("/api/users/{$user->id}", [
            'name' => 'New Name'
        ]);

        $response->assertStatus(200);
    }

    /**
     * Prueba para eliminar un usuario.
     */
    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->delete("/api/users/{$user->id}");

        $response->assertStatus(200);
    }
}
