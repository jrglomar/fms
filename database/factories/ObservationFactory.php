<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class ObservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_of_observation' => $this->faker->datetime(),
            'remarks' => $this->faker->text(30),
            'proof_of_observation_file_directory' => $this->faker->file($sourceDir = 'C:\xampp', $targetDir = 'C:\xampp\htdocs', false),
            'proof_of_observation_file_link' => $this->faker->imageUrl($width = 640, $height = 480),
            'schedule_id' => $this->faker->uuid,
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}
