<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            if ($method == 'get') {
                $response = $this->getJson($route);
            } elseif ($method == 'post') {
                $response = $this->postJson($route);
            } elseif ($method == 'put') {
                $response = $this->putJson($route);
            } elseif ($method == 'delete') {
                $response = $this->deleteJson($route);
            } else {
                // Unsupported HTTP method
                continue;
            }

            // Verificar que la ruta es accesible
            $response->assertStatus(200);

            // Agregar pruebas adicionales según la ruta si es necesario
            if ($route == '/api/products') {
                // Verificar la estructura de la respuesta para la ruta /api/products
                $response->assertJsonStructure([
                    'success', 'data' => [['id', 'name', 'price']]
                ]);
            } elseif ($route == '/api/tickets') {
                // Verificar la estructura de la respuesta para la ruta /api/tickets
                $response->assertJsonStructure([
                    'success', 'data' => [['id', 'status', 'address', 'phone', 'total', 'user_id', 'name', 'lastname', 'email']]
                ]);
            } elseif ($route == '/api/login') {
                // Verificar la estructura de la respuesta para la ruta /api/login
                $response->assertJsonStructure([
                    'success', 'data' => ['user', 'token']
                ]);
            } elseif ($route == '/api/register') {
                // Verificar la estructura de la respuesta para la ruta /api/register
                $response->assertJsonStructure([
                    'success', 'data' => ['user', 'token']
                ]);
            } elseif ($route == '/api/logout') {
                // Verificar que la sesión se haya cerrado correctamente
                $response->assertJson([
                    'message' => 'Token eliminado'
                ]);
            } elseif (strpos($route, '/api/cancelar/') !== false) {
                // Verificar el comportamiento de cancelación del ticket si es necesario
                // Por ejemplo, verificar si el ticket se ha cancelado correctamente
                $response->assertJson([
                    'message' => 'Ticket cancelado con éxito'
                ]);
            }
            // Agregar más pruebas según sea necesario
        }
    }
}
