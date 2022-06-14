<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\ActivityType;

class ActivityFactory extends Factory
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
            "status" => $this->faker->word(10),
            "memorandum_file_directory" => $this->faker->file($sourceDir = 'C:\xampp', $targetDir = 'C:\xampp\htdocs', false),
            "start_datetime" => $this->faker->dateTime($timezone = 'PHT'),
            "end_datetime" => $this->faker->dateTime($timezone = 'PHT'),
            "activity_type_id" => ActivityType::factory(),
            "created_by" => User::factory(),
            "updated_by" => User::factory()
        ];
    }
}
