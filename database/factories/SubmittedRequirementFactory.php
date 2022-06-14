<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\SubmittedRequirementFolder;

class SubmittedRequirementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "date_submitted" => $this->faker->dateTime($timezone = 'PHT'),
            "remarks" => $this->faker->text(20),
            "status" => $this->faker->word(10),
            "file_link" => $this->faker->file($sourceDir = 'C:\xampp', $targetDir = 'C:\xampp\htdocs', false),
            "file_link_directory" => $this->faker->imageUrl($width = 640, $height = 480),
            "submitted_requirement_folder_id" => SubmittedRequirementFolder::factory(),
            "created_by" => User::factory(),
            "updated_by" => User::factory(),
        ];
    }
}
