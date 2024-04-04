<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba para obtener todos los tickets del usuario autenticado.
     */
    public function test_get_all_tickets()
    {
        $user = \App\Models\User::factory()->create();
        $tickets = Ticket::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/api/tickets');

        $response->assertStatus(200);
        $response->assertJson($tickets->toArray());
    }

    /**
     * Prueba para crear un nuevo ticket.
     */
    public function test_create_ticket()
    {
        $product = Product::factory()->create(['stock' => 10]);

        $response = $this->post('/api/tickets', [
            'address' => '123 Calle Principal',
            'phone' => '555-555-5555',
            'items' => [
                ['id' => $product->id, 'quantity' => 2]
            ]
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Ticket creado con éxito y productos vendidos con éxito'
        ]);
    }

    /**
     * Prueba para cancelar un ticket.
     */
    public function test_cancel_ticket()
    {
        $ticket = Ticket::factory()->create(['status' => 'pendiente']);

        $response = $this->post("/api/tickets/{$ticket->id}/cancel");

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Ticket cancelado con éxito'
        ]);
    }

    /**
     * Prueba para obtener un ticket específico.
     */
    public function test_get_specific_ticket()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get("/api/tickets/{$ticket->id}");

        $response->assertStatus(200);
        // Ajusta esto según la estructura de datos que esperas en la respuesta JSON
    }

    /**
     * Prueba para actualizar un ticket.
     */
    public function test_update_ticket()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->put("/api/tickets/{$ticket->id}", [
            // Aquí coloca los datos que deseas actualizar en el ticket
        ]);

        $response->assertStatus(200);
        // Ajusta esto según la estructura de datos que esperas en la respuesta JSON
    }

    /**
     * Prueba para eliminar un ticket.
     */
    public function test_delete_ticket()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->delete("/api/tickets/{$ticket->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
    }
}
