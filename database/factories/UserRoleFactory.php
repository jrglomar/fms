<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Role;

class UserRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::factory(),
            "role_id" => Role::factory(),
            "created_by" => User::factory(),
            "updated_by" => User::factory()
        ];
    }
}
