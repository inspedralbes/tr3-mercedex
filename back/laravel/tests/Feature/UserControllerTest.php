<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $response->assertJsonStructure([
            'success', 'data' => ['user' => ['id', 'name', 'email'], 'token']
        ]);
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
        $response->assertJsonStructure([
            'success', 'data' => ['user' => ['id', 'name', 'email'], 'token']
        ]);
    }

    /**
     * Prueba para cerrar sesión.
     */
    public function test_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->actingAs($user)->post('/api/logout');

        $response->assertStatus(200);
        $this->assertNull($user->fresh()->currentAccessToken());
    }

    /**
     * Prueba para obtener todos los usuarios.
     */
    public function test_get_all_users()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get('/api/users');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
        $response->assertJsonStructure([
            'success', 'data' => [['id', 'name', 'email']]
        ]);
    }

    /**
     * Prueba para obtener un usuario específico.
     */
    public function test_get_specific_user()
    {
        $user = User::factory()->create();

        $response = $this->get("/api/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success', 'data' => ['id', 'name', 'email']
        ]);
    }

    /**
     * Prueba para actualizar un usuario.
     */
    public function test_update_user()
    {
        $user = User::factory()->create();
        $newName = 'New Name';

        $response = $this->put("/api/users/{$user->id}", [
            'name' => $newName
        ]);

        $response->assertStatus(200);
        $this->assertEquals($newName, $user->fresh()->name);
    }

    /**
     * Prueba para eliminar un usuario.
     */
    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->delete("/api/users/{$user->id}");

        $response->assertStatus(200);
        $this->assertDeleted($user);
    }
}
