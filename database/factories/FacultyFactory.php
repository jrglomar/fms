<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Faculty;

class FacultyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */



    public function definition()
    {
        return [
            "first_name" => $this->faker->firstName,
            "middle_name" => $this->faker->lastName,
            "last_name" => $this->faker->lastName,
            "contact_number" => $this->faker->phoneNumber,
            "user_id" => User::factory(),
            "faculty_type_id" => FacultyType::factory(),
            "academic_rank_id" => AcademicRank::factory(),
            "designation_id" => Designation::factory(),
            "created_by" => User::factory(),
            "updated_by" => User::factory()
        ];
    }
}
