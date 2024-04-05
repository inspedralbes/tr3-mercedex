<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 'pendiente',
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'total' => $this->faker->randomFloat(2, 10, 100),
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->email,
        ];
    }
}