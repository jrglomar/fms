<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\RequirementBin;
use App\Models\RequirementType;

class RequirementListTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "requirement_bin_id" => RequirementBin::factory(),
            "requirement_type_id" => RequirementType::factory(),
            "created_by" => User::factory(),
            "updated_by" => User::factory()
        ];
    }
}
