<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Activity;
use App\Models\Faculty;

class ActivityAttendanceRequiredFacultyListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "time_in" => $this->faker->date('H:i:s', rand(1,54000)),
            "time_out" => $this->faker->date('H:i:s', rand(1,54000)),
            "attendance_status" => $this->faker->word(10),
            'proof_of_attendance_file_directory' => $this->faker->file($sourceDir = 'C:\xampp', $targetDir = 'C:\xampp\htdocs', false),
            'proof_of_attendance_file_link' => $this->faker->imageUrl($width = 640, $height = 480),
            "activity_id" => Activity::factory(),
            "faculty_id" => Faculty::factory(),
            "created_by" => User::factory(),
            "updated_by" => User::factory()
        ];
    }
}
