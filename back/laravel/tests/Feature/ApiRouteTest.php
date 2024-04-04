<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba para verificar que todas las rutas devuelvan un código de estado 200.
     */
    public function test_all_routes_accessible()
    {
        $routes = [
            '/api/ventas' => 'post',
            '/api/tickets' => 'get',
            '/api/logout' => 'post',
            '/api/cancelar/1' => 'post',
            '/api/products' => 'get',
            '/api/login' => 'post',
            '/api/register' => 'post',
        ];

        foreach ($routes as $route => $method) {
            $response = $this->getJson($route);

            // Verificar que la ruta es accesible
            $response->assertStatus(200);
        }
    }
}
