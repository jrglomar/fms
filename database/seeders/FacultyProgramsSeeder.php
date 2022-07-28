<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacultyProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FacultyProgram::factory(10)->create();
    }
}
