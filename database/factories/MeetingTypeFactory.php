<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class MeetingTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->word(10),
            "description" => $this->faker->text(20),
            "created_by" => User::factory(),
            "updated_by" => User::factory()
        ];
    }
}
