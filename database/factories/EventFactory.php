<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->date;
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => $startDate,
            'end_date' => $this->faker->dateTimeBetween($startDate),
            'timeline_id' => \App\Models\Timeline::factory(),
        ];
    }
}
