<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        Ticket::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/api/tickets');

        $response->assertStatus(200);
    }

    // /**
    //  * Prueba para crear un nuevo ticket.
    //  */
    // public function test_create_ticket()
    // {
    //     Product::factory()->create(['stock' => 10]);

    //     $response = $this->post('/api/tickets', [
    //         'address' => '123 Calle Principal',
    //         'phone' => '555-555-5555',
    //         'items' => [
    //             ['id' => 1, 'quantity' => 2] // Ajusta según la estructura de datos esperada
    //         ]
    //     ]);

    //     $response->assertStatus(200);
    // }

    /**
     * Prueba para cancelar un ticket.
     */
    public function test_cancel_ticket()
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create(['status' => 'pendiente']);

        $response = $this->actingAs($user)->post("/api/cancelar/{$ticket->id}");

        $response->assertStatus(200);
    }

    // /**
    //  * Prueba para obtener un ticket específico.
    //  */
    // public function test_get_specific_ticket()
    // {
    //     $ticket = Ticket::factory()->create();

    //     $response = $this->get("/api/tickets/{$ticket->id}");

    //     $response->assertStatus(200);
    // }

    // /**
    //  * Prueba para actualizar un ticket.
    //  */
    // public function test_update_ticket()
    // {
    //     $ticket = Ticket::factory()->create();

    //     $response = $this->put("/api/tickets/{$ticket->id}", [
    //         // Coloca aquí los datos que deseas actualizar en el ticket
    //     ]);

    //     $response->assertStatus(200);
    // }

    // /**
    //  * Prueba para eliminar un ticket.
    //  */
    // public function test_delete_ticket()
    // {
    //     $ticket = Ticket::factory()->create();

    //     $response = $this->delete("/api/tickets/{$ticket->id}");

    //     $response->assertStatus(204);
    // }
}
