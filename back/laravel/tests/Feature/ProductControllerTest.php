<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba para obtener todos los productos.
     */
    public function test_get_all_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'products' => [
                '*' => ['id', 'name', 'price']
            ]
        ]);
    }

    /**
     * Prueba para crear un nuevo producto.
     */
    public function test_create_product()
    {
        $response = $this->post('/api/products', [
            'name' => 'Nuevo Producto',
            'price' => 19.99,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id', 'name', 'price'
        ]);
    }

    /**
     * Prueba para obtener un producto específico.
     */
    public function test_get_specific_product()
    {
        $product = Product::factory()->create();

        $response = $this->get("/api/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
        ]);
    }

    /**
     * Prueba para actualizar un producto.
     */
    public function test_update_product()
    {
        $product = Product::factory()->create();

        $response = $this->put("/api/products/{$product->id}", [
            'name' => 'Producto Actualizado',
            'price' => 29.99,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $product->id,
            'name' => 'Producto Actualizado',
            'price' => 29.99,
        ]);
    }

    /**
     * Prueba para eliminar un producto.
     */
    public function test_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/api/products/{$product->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
