<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityAttendanceRequiredFacultyList;

class ActivityAttendanceRequiredFacultyListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ActivityAttendanceRequiredFacultyList::factory(10)->create();
    }
}
