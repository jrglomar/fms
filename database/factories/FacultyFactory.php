<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Faculty;
use App\Models\FacultyType;
use App\Models\AcademicRank;
use App\Models\Designation;

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
            "gender" => $this->faker->word(6),
            "image" => $this->faker->imageUrl($width = 640, $height = 480),
            "salutation" => $this->faker->title,
            "birthdate" => $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = '-15 years'),
            "birthplace" => $this->faker->city,
            "hire_date" => $this->faker->dateTime($timezone = 'PHT'),
            "email" => $this->faker->phoneNumber,
            "phone_number" => $this->faker->phoneNumber,
            "province" => $this->faker->state,
            "city" => $this->faker->city,
            "barangay" => $this->faker->streetName,
            "street" => $this->faker->streetName,
            "house_number" => $this->faker->buildingNumber,
            "user_id" => User::factory(),
            "faculty_type_id" => FacultyType::factory(),
            "academic_rank_id" => AcademicRank::factory(),
            "designation_id" => Designation::factory(),
            "created_by" => User::factory(),
            "updated_by" => User::factory()
        ];
    }
}
