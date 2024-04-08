<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Ticket;

class ApiRouteTest extends TestCase
{
    /**
     * Test the ventas route.
     *
     * @return void
     */
    public function testVentasRoute()
    {
        // Crear un usuario de prueba
        $user = User::factory()->create();

        // Crear un token de Sanctum para el usuario
        $token = $user->createToken('test-token')->plainTextToken;

        // Crear un producto de prueba
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'stock' => 10,
            'price' => 100,
            'image' => 'path/to/image.jpg',
        ]);

        // Datos de la solicitud
        $data = [
            'address' => '123 Test Street',
            'phone' => '1234567890',
            'items' => [
                [
                    'id' => $product->id,
                    'quantity' => 1,
                ],
            ],
        ];

        // Enviar la solicitud con el token de Sanctum en la cabecera
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/ventas', $data);

        // Asegurarse de que la respuesta tenga un estado HTTP 200
        $response->assertStatus(200);

        // Asegurarse de que la respuesta tenga el mensaje esperado
        $response->assertJson(['message' => 'Ticket creado con éxito y productos vendidos con éxito']);
    }

    /**
     * Test the tickets route.
     *
     * @return void
     */
    public function testTicketsRoute()
    {
        // Crear un usuario de prueba
        $user = User::factory()->create();

        // Crear un token de Sanctum para el usuario
        $token = $user->createToken('test-token')->plainTextToken;

        // Enviar la solicitud con el token de Sanctum en la cabecera
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/tickets');

        // Asegurarse de que la respuesta tenga un estado HTTP 200
        $response->assertStatus(200);
    }

    /**
     * Test the logout route.
     *
     * @return void
     */
    public function testLogoutRoute()
    {
        // Crear un usuario de prueba
        $user = User::factory()->create();

        // Crear un token de Sanctum para el usuario
        $token = $user->createToken('test-token')->plainTextToken;

        // Enviar la solicitud con el token de Sanctum en la cabecera
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/logout');

        // Asegurarse de que la respuesta tenga un estado HTTP 200
        $response->assertStatus(200);
    }

    /**
     * Test the cancelar route.
     *
     * @return void
     */
    public function testCancelRoute()
    {
        // Crear un usuario y un ticket para ese usuario
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        // Autenticar como el usuario
        $this->actingAs($user);

        // Enviar la solicitud de cancelación
        $response = $this->post('/api/cancelar/' . $ticket->id);

        // Asegurarse de que la respuesta tenga un estado HTTP 200
        $response->assertStatus(200);

        // Asegurarse de que el ticket fue cancelado
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'status' => 'cancelado',
        ]);
    }

    /**
     * Test the products route.
     *
     * @return void
     */
    public function testProductsRoute()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }

    /**
     * Test the login route.
     *
     * @return void
     */
    public function testLoginRoute()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Enviar la solicitud de inicio de sesión
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password', // Asume que la contraseña es 'password'
        ]);

        // Asegurarse de que la respuesta tenga un estado HTTP 200
        $response->assertStatus(200);

        // Asegurarse de que la respuesta contenga un token
        $responseData = $response->json('data');
        $this->assertNotNull($responseData['token']);
    }

    /**
     * Test the register route.
     *
     * @return void
     */
    public function testRegisterRoute()
    {
        // Datos de registro
        $data = [
            'name' => 'Test User',
            'surnames' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Enviar la solicitud de registro
        $response = $this->post('/api/register', $data);

        // Asegurarse de que la respuesta tenga un estado HTTP 200
        $response->assertStatus(200);

        // Asegurarse de que el usuario fue creado
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }
}