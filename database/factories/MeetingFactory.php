<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\MeetingType;

class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "start_time" => $this->faker->date('H:i:s', rand(1,54000)),
            "end_time" => $this->faker->date('H:i:s', rand(1,54000)),
            "agenda" => $this->faker->word(10),
            "status" => $this->faker->word(10),
            "title" => $this->faker->word(10),
            "description" => $this->faker->text(20),
            "meeting_types_id" => MeetingType::factory(),
            "created_by" => User::factory(),
            "updated_by" => User::factory()
        ];
    }
}
