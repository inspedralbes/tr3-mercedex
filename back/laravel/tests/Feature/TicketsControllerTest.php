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

    
}
