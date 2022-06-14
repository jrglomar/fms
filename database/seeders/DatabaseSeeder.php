<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(AcademicRanksSeeder::class);
        $this->call(DesignationsSeeder::class);
        $this->call(FacultyTypesSeeder::class);
        $this->call(FacultiesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(ObservationsSeeder::class);
        $this->call(RequirementTypesSeeder::class);
        $this->call(RequirementBinsSeeder::class);
        $this->call(RequirementListTypesSeeder::class);
        $this->call(RequirementRequiredFacultyListsSeeder::class);
        $this->call(SubmittedRequirementFoldersSeeder::class);
        $this->call(SubmittedRequirementsSeeder::class);
        $this->call(ActivityTypesSeeder::class);
        $this->call(ActivitiesSeeder::class);
        $this->call(ActivityAttendanceRequiredFacultyListsSeeder::class);
        $this->call(MeetingTypesSeeder::class);
        $this->call(MeetingsSeeder::class);
        $this->call(MeetingAttendanceRequiredFacultyListsSeeder::class);
    }
}
