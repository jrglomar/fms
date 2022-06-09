<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacultyType;

class FacultyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FacultyType::factory(10)->create();
    }
}
