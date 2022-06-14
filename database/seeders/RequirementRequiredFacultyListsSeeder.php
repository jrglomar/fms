<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RequirementRequiredFacultyListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RequirementRequiredFacultyList::factory(10)->create();
    }
}
