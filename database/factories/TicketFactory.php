<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => \App\Models\Customer::factory(),
            'subject' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(),
            'status' => fake()->randomElement(['new', 'in_progress', 'processed']),
            'replied_at' => null,
        ];
    }
}
