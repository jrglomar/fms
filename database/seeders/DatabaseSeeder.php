<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PresentationsSeeder::class);
        
        // $this->call(UsersSeeder::class);
        // $this->call(AcademicRanksSeeder::class);
        // $this->call(DesignationsSeeder::class);
        // $this->call(FacultyTypesSeeder::class);
        // $this->call(FacultiesSeeder::class);
        // $this->call(RolesSeeder::class);
        // $this->call(UserRolesSeeder::class);
        // $this->call(RequirementTypesSeeder::class);
        // $this->call(ActivityTypesSeeder::class);
        // $this->call(MeetingTypesSeeder::class);
        
        // $this->call(ObservationsSeeder::class);
        // $this->call(RequirementBinsSeeder::class);
        // $this->call(RequirementListTypesSeeder::class);
        // $this->call(RequirementRequiredFacultyListsSeeder::class);
        // $this->call(SubmittedRequirementFoldersSeeder::class);
        // $this->call(SubmittedRequirementsSeeder::class);
        // $this->call(ActivitiesSeeder::class);
        // $this->call(ActivityAttendanceRequiredFacultyListsSeeder::class);
        // $this->call(MeetingsSeeder::class);
        // $this->call(MeetingAttendanceRequiredFacultyListsSeeder::class);
    }
}
