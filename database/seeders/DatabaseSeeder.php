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
        // $this->call(UsersSeeder::class);
        // $this->call(AcademicRanksSeeder::class);
        // $this->call(DesignationsSeeder::class);
        // $this->call(FacultyTypesSeeder::class);
        // $this->call(FacultiesSeeder::class);
        // $this->call(RolesSeeder::class);
        // $this->call(UserRolesSeeder::class);
        // $this->call(ObservationsSeeder::class);
        // $this->call(RequirementTypesSeeder::class);
        // $this->call(RequirementBinsSeeder::class);
        // $this->call(RequirementListTypesSeeder::class);
        // $this->call(RequirementRequiredFacultyListsSeeder::class);
        // $this->call(SubmittedRequirementFoldersSeeder::class);
        // $this->call(SubmittedRequirementsSeeder::class);
        // $this->call(ActivityTypesSeeder::class);
        // $this->call(ActivitiesSeeder::class);
        // $this->call(ActivityAttendanceRequiredFacultyListsSeeder::class);
        // $this->call(MeetingTypesSeeder::class);
        // $this->call(MeetingsSeeder::class);
        // $this->call(MeetingAttendanceRequiredFacultyListsSeeder::class);

        DB::table('users')->insert([
            'id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'created_at' => '2022-06-22 16:25:03',
            'updated_at' => '2022-06-22 16:25:03',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('User01'),
        ]);

        DB::table('roles')->insert([
            'id' => '3a5358f3-f0ab-4654-8cac-5c1282a81ff8',
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Admin',
        ]);

        DB::table('user_roles')->insert([
            'id' => '72a1a0be-8ef8-47fb-b5fa-6eb84097162e',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => '3a5358f3-f0ab-4654-8cac-5c1282a81ff8',
        ]);
    }
}
