<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }

    
}
