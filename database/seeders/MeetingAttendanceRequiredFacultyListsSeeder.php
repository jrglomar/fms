<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeetingAttendanceRequiredFacultyList;

class MeetingAttendanceRequiredFacultyListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MeetingAttendanceRequiredFacultyList::factory(10)->create();
    }
}
