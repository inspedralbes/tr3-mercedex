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
        $user = User::factory()->create();

        $token = $user->createToken('test-token')->plainTextToken;

        $product = Product::factory()->create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'stock' => 10,
            'price' => 100,
            'image' => 'path/to/image.jpg',
            'category' => 'Test Category',
        ]);

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

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/ventas', $data);

        $response->assertStatus(200);

        // Verifica que la respuesta contenga el campo 'id'
        $response->assertJsonStructure(['id']);
    }

    /**
     * Test the tickets route.
     *
     * @return void
     */
    public function testTicketsRoute()
    {
        $user = User::factory()->create();

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/tickets');

        $response->assertStatus(200);
    }

    /**
     * Test the logout route.
     *
     * @return void
     */
    public function testLogoutRoute()
    {
        $user = User::factory()->create();

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/logout');

        $response->assertStatus(200);
    }

    /**
     * Test the cancelar route.
     *
     * @return void
     */
    public function testCancelRoute()
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->post('/api/cancelar/' . $ticket->id);

        $response->assertStatus(200);

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
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);

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
        $data = [
            'name' => 'Test User',
            'surnames' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/api/register', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }
}