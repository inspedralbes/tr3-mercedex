<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => 'open', // Estado predeterminado: abierto
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']), // Prioridad aleatoria
            'user_id' => \App\Models\User::factory(), // Relación con un usuario (requiere existir el modelo User y su factory)
        ];
    }
}
