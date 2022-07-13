<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PresentationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            'id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'created_at' => '2022-06-22 16:25:03',
            'updated_at' => '2022-06-22 16:25:03',
            'email' => 'admin@pupqc.com',
            'password' => Hash::make('User01'),
            'status' => 'Active',
        ]);

        DB::table('academic_ranks')->insert([
            'id' => 'c77357e3-66a5-4f67-8b41-4cc6bc19ef7a',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Instructor',
            'description' => 'Instructor'
        ]);

        DB::table('academic_ranks')->insert([
            'id' => '260bbc2f-3310-49a3-b8d7-6d9a51f404e0',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Professor',
            'description' => 'Professor'
        ]);

        DB::table('academic_ranks')->insert([
            'id' => 'fad81358-af96-4bdc-8227-9359782b2edb',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Associate Professor',
            'description' => 'Associate Professor'
        ]);

        DB::table('academic_ranks')->insert([
            'id' => '2e7e0dc1-c10d-4eb8-97a5-7c016281808e',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Assistant Professor',
            'description' => 'Assistant Professor'
        ]);

        DB::table('designations')->insert([
            'id' => 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Research Professor',
            'description' => 'Research Professor'
        ]);
        DB::table('designations')->insert([
            'id' => 'fdd1cd40-1da3-4773-81c7-6be2131a73f2',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Faculty Extensionist',
            'description' => 'Faculty Extensionist'
        ]);

        DB::table('faculty_types')->insert([
            'id' => '00515f7c-b267-4f4e-870e-5cc9a9e84a43',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Part time',
            'description' => 'Part time'
        ]);
        DB::table('faculty_types')->insert([
            'id' => '7fab7e70-8bc4-4384-881f-654b40e19cf3',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Temporary',
            'description' => 'Temporary'
        ]);
        DB::table('faculty_types')->insert([
            'id' => '000267aa-d29c-4e91-afd6-0f68a5d86f4a',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Regular',
            'description' => 'Regular'
        ]);

        DB::table('faculties')->insert([
            'id' => '3a5358f3-f0ab-4654-8cac-5c1282a81ff8',
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'salutation' => 'Mr.',
            'first_name' => 'John Raven',
            'middle_name' => 'Tamang',
            'last_name' => 'Glomar',
            'gender' => 'Male',
            'birthdate' => '1999-11-16',
            'birthplace' => 'Quezon City',
            'hire_date' => '2022-05-01',
            'phone_number' => '09398718861',
            'province' => 'Bicol',
            'city' => 'Quezon City',
            'barangay' => 'Commonwealth',
            'street' => 'Adarna',
            'house_number' => 'Lot 13',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'faculty_type_id' => '00515f7c-b267-4f4e-870e-5cc9a9e84a43',
            'academic_rank_id' => 'c77357e3-66a5-4f67-8b41-4cc6bc19ef7a',
            'designation_id' => 'fdd1cd40-1da3-4773-81c7-6be2131a73f2',
            'image' => 'images/faculty_images/admin.jpg'
        ]);

        DB::table('roles')->insert([
            'id' => '3a5358f3-f0ab-4654-8cac-5c1282a81ff8',
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'id' => 'b386fdb9-5197-4ac2-b198-6384323af036',
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Faculty',
        ]);
        DB::table('roles')->insert([
            'id' => 'da39b66a-9fcb-405f-a79e-60defd788ea8',
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Checker',
        ]);
        DB::table('roles')->insert([
            'id' => 'd2a81b5a-0228-48e2-8ccc-1a4820e26fa9',
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Academic Head',
        ]);

        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => '3a5358f3-f0ab-4654-8cac-5c1282a81ff8',
        ]);
        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => 'b386fdb9-5197-4ac2-b198-6384323af036',
        ]);
        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => 'da39b66a-9fcb-405f-a79e-60defd788ea8',
        ]);
        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => 'd2a81b5a-0228-48e2-8ccc-1a4820e26fa9',
        ]);

        DB::table('requirement_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Memo'
        ]);
        DB::table('requirement_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Proof of Meeting/Activity Attendance'
        ]);
        DB::table('requirement_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Class Masterlist'
        ]);

        DB::table('activity_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Online'
        ]);
        DB::table('activity_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Face-to-Face'
        ]);

        DB::table('meeting_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Innovation Meetings'
        ]);
        DB::table('meeting_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Problem Solving'
        ]);
        DB::table('meeting_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Status Update'
        ]);
        DB::table('meeting_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Decision Making'
        ]);
        DB::table('meeting_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Team Building'
        ]);
        DB::table('meeting_types')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Information Sharing'
        ]);

        DB::table('requirement_bins')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'e905dd31-1d60-4286-a598-69e5fd686a2b',
            'title' => 'Getting Started with Interview Preparation – Free online Course in Simplilearn',
            'description' => 'Please print or take screenshot of your Certificates in completing the course of “Getting Started with Interview Preparation”. A submission bin will be uploaded in your google classroom.',
            'deadline' => '2022-07-31 17:00:00',
        ]);
    }
}
