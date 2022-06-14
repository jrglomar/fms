<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Model\RequirementType;

class RequirementTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RequirementType::factory(10)->create();
    }
}
