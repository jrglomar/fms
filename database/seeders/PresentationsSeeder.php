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
        // ADMIN USER
        DB::table('users')->insert([
            'id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'created_at' => '2022-06-22 16:25:03',
            'updated_at' => '2022-06-22 16:25:03',
            'email' => 'admin@pupqc.com',
            'password' => Hash::make('User01'),
            'status' => 'Active',
        ]);
        // ACAD HEAD USER
        DB::table('users')->insert([
            'id' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'created_at' => '2022-06-22 16:25:03',
            'updated_at' => '2022-06-22 16:25:03',
            'email' => 'acadhead@pupqc.com',
            'password' => Hash::make('User01'),
            'status' => 'Active',
        ]);
        // FACULTY USER
        DB::table('users')->insert([
            'id' => 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027',
            'created_at' => '2022-06-22 16:25:03',
            'updated_at' => '2022-06-22 16:25:03',
            'email' => 'faculty@pupqc.com',
            'password' => Hash::make('User01'),
            'status' => 'Active',
        ]);
        // FACULTY TWO USER
        DB::table('users')->insert([
            'id' => 'bc118579-e632-4221-9521-f5f40aee62d6',
            'created_at' => '2022-06-22 16:25:03',
            'updated_at' => '2022-06-22 16:25:03',
            'email' => 'faculty2@pupqc.com',
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
        
        DB::table('specializations')->insert([
            'id' => 'dc7c6fa9-da61-4c2d-adbc-43o8f13b7af8',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Human Resource Management',
            'description' => 'Human Resource Management'
        ]);
        DB::table('specializations')->insert([
            'id' => 'ddf1cd40-1da3-4773-81d7-6be2131a73e2',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Guidance and Counseling/ Psychology',
            'description' => 'Guidance and Counseling/ Psychology'
        ]);

        DB::table('programs')->insert([
            'id' => 'dd7a6fa9-dd61-4c2d-acbd-43o8c13d7af8',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'BSBA - HRM',
            'description' => 'BSBA - HRM'
        ]);
        DB::table('programs')->insert([
            'id' => 'adf1ac40-1df3-4773-81d7-6bb2131c73f2',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Gen Ed',
            'description' => 'Gen Ed'
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
            'role_id' => 'd2a81b5a-0228-48e2-8ccc-1a4820e26fa9',
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
            'role_id' => 'b386fdb9-5197-4ac2-b198-6384323af036',
        ]);

        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027',
            'role_id' => 'b386fdb9-5197-4ac2-b198-6384323af036',
        ]);
        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'bc118579-e632-4221-9521-f5f40aee62d6',
            'role_id' => 'b386fdb9-5197-4ac2-b198-6384323af036',
        ]);
        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'role_id' => 'd2a81b5a-0228-48e2-8ccc-1a4820e26fa9',
        ]);

        DB::table('requirement_types')->insert([
            'id' => 'f2be5628-3a7e-4a6b-9d56-e0efca1fd9b6',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Memo'
        ]);
        DB::table('requirement_types')->insert([
            'id' => '9934756d-1198-4013-b9db-7bece59fdcd3',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Proof of Meeting/Activity Attendance'
        ]);
        DB::table('requirement_types')->insert([
            'id' => '89c87eb3-2604-49fe-8023-cd39ed3294ae',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Class Masterlist'
        ]);

        DB::table('activity_types')->insert([
            'id' => '9c7ea8df-50ff-4b0a-8efd-118a3d8baee5',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Faculty Meeting',
            'category' => 'Meeting'
        ]);
        DB::table('activity_types')->insert([
            'id' => '2d4b3709-145c-4302-a9de-f782fcbceba7',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Flag Raising Ceremony',
            'category' => 'Activity'
        ]);
        DB::table('meeting_types')->insert([
            'id' => '4b66aad3-36e8-4eea-b75d-52b3864797b0',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Innovation Meetings'
        ]);
        DB::table('meeting_types')->insert([
            'id' => '9ee1b2c2-25c9-4c07-9028-c431f0a6658b',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Problem Solving'
        ]);
        DB::table('meeting_types')->insert([
            'id' => '40fed866-6a6e-42eb-b863-636653d6de1f',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Status Update'
        ]);
        DB::table('meeting_types')->insert([
            'id' => '04cfd446-4b29-4b12-ad30-b1e84313957a',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Decision Making'
        ]);
        DB::table('meeting_types')->insert([
            'id' => '9931ad4e-1f61-4d85-852d-43b240012e48',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Team Building'
        ]);
        DB::table('meeting_types')->insert([
            'id' => '3463651f-882c-497c-bbc4-7285b0fb897e',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Information Sharing'
        ]);

        // ADMIN ACCOUNT
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
            'image' => 'images/faculty_images/9a5cc9db88de7e58b82c30333e1d7a4b.png',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'faculty_type_id' => '00515f7c-b267-4f4e-870e-5cc9a9e84a43',
            'academic_rank_id' => 'c77357e3-66a5-4f67-8b41-4cc6bc19ef7a',
            'designation_id' => 'fdd1cd40-1da3-4773-81c7-6be2131a73f2',
            'specialization_id' => 'dc7c6fa9-da61-4c2d-adbc-43o8f13b7af8',
            'program_id' => 'adf1ac40-1df3-4773-81d7-6bb2131c73f2'
        ]);

        // ACAD HEAD ACCOUNT
        DB::table('faculties')->insert([
            'id' => 'd7376448-3059-4a0e-b48b-16a0dc00fd78',
            'created_at' => '2022-07-19 04:23:00',
            'updated_at' => '2022-07-19 04:23:00',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'salutation' => 'Ms.',
            'first_name' => 'Acad',
            'last_name' => 'Head',
            'gender' => 'Female',
            'birthdate' => '1999-11-16',
            'birthplace' => 'Quezon City',
            'hire_date' => '2022-05-01',
            'phone_number' => '09398718861',
            'province' => 'Bicol',
            'city' => 'Quezon City',
            'barangay' => 'Commonwealth',
            'street' => 'Adarna',
            'house_number' => 'Lot 13',
            'user_id' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'faculty_type_id' => '000267aa-d29c-4e91-afd6-0f68a5d86f4a',
            'academic_rank_id' => '260bbc2f-3310-49a3-b8d7-6d9a51f404e0',
            'designation_id' => 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8',
            'specialization_id' => 'ddf1cd40-1da3-4773-81d7-6be2131a73e2',
            'program_id' => 'dd7a6fa9-dd61-4c2d-acbd-43o8c13d7af8'
        ]);

        // FACULTY ONE ACCOUNT
        DB::table('faculties')->insert([
            'id' => '4b6b9410-3191-47e1-8504-c9ae4d070d6c',
            'created_at' => '2022-07-19 04:23:00',
            'updated_at' => '2022-07-19 04:23:00',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'salutation' => 'Ms.',
            'first_name' => 'Faculty',
            'last_name' => 'One',
            'gender' => 'Female',
            'birthdate' => '1999-11-16',
            'birthplace' => 'Quezon City',
            'hire_date' => '2022-05-01',
            'phone_number' => '09398718861',
            'province' => 'Bicol',
            'city' => 'Quezon City',
            'barangay' => 'Commonwealth',
            'street' => 'Adarna',
            'house_number' => 'Lot 13',
            'user_id' => 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027',
            'faculty_type_id' => '7fab7e70-8bc4-4384-881f-654b40e19cf3',
            'academic_rank_id' => '260bbc2f-3310-49a3-b8d7-6d9a51f404e0',
            'designation_id' => 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8',
            'specialization_id' => 'dc7c6fa9-da61-4c2d-adbc-43o8f13b7af8',
            'program_id' => 'adf1ac40-1df3-4773-81d7-6bb2131c73f2'
        ]);

        // FACULTY TWO ACCOUNT
        DB::table('faculties')->insert([
            'id' => '5d230a37-7717-47c1-b8a9-c2b55229d2d1',
            'created_at' => '2022-07-19 04:23:00',
            'updated_at' => '2022-07-19 04:23:00',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'salutation' => 'Ms.',
            'first_name' => 'Faculty',
            'last_name' => 'Two',
            'gender' => 'Female',
            'birthdate' => '1999-11-16',
            'birthplace' => 'Quezon City',
            'hire_date' => '2022-05-01',
            'phone_number' => '09398718861',
            'province' => 'Bicol',
            'city' => 'Quezon City',
            'barangay' => 'Commonwealth',
            'street' => 'Adarna',
            'house_number' => 'Lot 13',
            'user_id' => 'bc118579-e632-4221-9521-f5f40aee62d6',
            'faculty_type_id' => '7fab7e70-8bc4-4384-881f-654b40e19cf3',
            'academic_rank_id' => '2e7e0dc1-c10d-4eb8-97a5-7c016281808e',
            'designation_id' => 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8',
            'specialization_id' => 'ddf1cd40-1da3-4773-81d7-6be2131a73e2',
            'program_id' => 'dd7a6fa9-dd61-4c2d-acbd-43o8c13d7af8'
        ]);

        // REQUIREMENT BINS
        DB::table('requirement_bins')->insert([
            'id' => '5f82c12b-6ca9-444b-bd10-b967949f3094',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'Getting Started with Interview Preparation – Free online Course in Simplilearn',
            'description' => 'Please print or take screenshot of your Certificates in completing the course of “Getting Started with Interview Preparation”. A submission bin will be uploaded in your google classroom.',
            'deadline' => '2022-11-30 17:00:00',
            'status' => 'On Going'
        ]);
        // REQUIREMENT BINS
        DB::table('requirement_bins')->insert([
            'id' => 'c28aa3ac-3ff5-49df-aaa3-fa145aa21f89',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'PUP Socioeconomic Survey',
            'description' => 'Please answer the PUP Socioeconomic Survey on or before July 1, 2022 12:00nn. You may access the survey in your SIS account. Thank you.',
            'deadline' => '2022-11-30 17:00:00',
            'status' => 'On Going'
        ]);
        // REQUIREMENT BINS
        DB::table('requirement_bins')->insert([
            'id' => '022185f3-84fe-432c-a9fa-c69e7a6be8fd',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'November Flag Raising Ceremony Attendance Form',
            'description' => 'Answer an attendance form that contains a person\'s name and their attendance information. To find out who was there that day, managers, supervisors, or teachers might look at the attendance sheet.',
            'deadline' => '2022-11-07 08:00:00',
            'status' => 'On Going'
        ]);

        // MEETINGS
        DB::table('meetings')->insert([
            'id' => '68110ff8-0593-400d-bb22-767c4eccfbb5',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'Individual Problem-Solving Meeting',
            'location' => 'Google Meet: https://meet.google.com/sbi-ckpu-jfe',
            'date' => '2022-11-07',
            'start_time' => '13:30:00',
            'end_time' => '16:00:00',
            'agenda' => 'Problem Analysis – Why Is the problem occurring?',
            'description' => 'Plan for students whose needs (academic/social-emotional/behavioral) are intensive or not making progress given supplemental support',
            'meeting_types_id' => '4b66aad3-36e8-4eea-b75d-52b3864797b0',
        ]);
        // MEETINGS
        DB::table('meetings')->insert([
            'id' => '749108a8-ef45-4f6b-bb61-283d32cfb939',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'Polytechnic University of the Philippines – Quezon City Branch Faculty Meeting',
            'location' => 'Via Zoom/Facebook Live',
            'date' => '2022-11-04',
            'start_time' => '13:30:00',
            'end_time' => '16:00:00',
            'agenda' => 'Dean’s Update',
            'description' => 'To improve internal communication within the Faculty and give you timely access to information that is significant and valuable to you, the Dean\'s monthly update was developed.',
            'meeting_types_id' => '40fed866-6a6e-42eb-b863-636653d6de1f',
        ]);
        // MEETINGS
        DB::table('meetings')->insert([
            'id' => 'fd371efa-9b5c-4970-9ff3-4cbfbcf3d29d',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'Polytechnic University of the Philippines – Quezon City Branch, Information Technology Faculty Decision Making Meeting',
            'location' => 'Faceboo Live',
            'date' => '2022-11-18',
            'start_time' => '13:30:00',
            'end_time' => '16:00:00',
            'agenda' => 'Address the problem in the IT field by deciding whether to terminate the contract',
            'description' => 'In order to make the jump from brainstorming potential solutions for solving a problem to evaluating and selecting the best solution, group members need to make decisions. The group holds a vote on a particular issue following a period of discussion. The majority wins.',
            'meeting_types_id' => '40fed866-6a6e-42eb-b863-636653d6de1f',
        ]);
        // ACTIVITIES
        DB::table('activities')->insert([
            'id' => '00d972b0-f337-4ed2-b067-7d919965b7ed',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'Re-opening of the Online Application for Graduation',
            'location' => 'Via Zoom/Facebook Live',
            'start_datetime' => '2022-09-27 00:00:00',
            'end_datetime' => '2022-11-01 23:59:00',
            'description' => 'Re-opening of the Online Application for Graduation',
            'status' => 'Pending',
            'activity_type_id' => '2d4b3709-145c-4302-a9de-f782fcbceba7',
        ]);
        // ACTIVITIES
        DB::table('activities')->insert([
            'id' => '3baf620f-a237-464e-8b79-3b6abb385101',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'November Flag Raising Ceremony',
            'location' => 'Via Zoom/Facebook Live',
            'start_datetime' => '2022-11-07 00:00:00',
            'end_datetime' => '2022-11-07 00:00:00',
            'description' => 'November 2022 Flag Raising Ceremony',
            'status' => 'Pending',
            'activity_type_id' => '9c7ea8df-50ff-4b0a-8efd-118a3d8baee5',
        ]);
        // ACTIVITIES
        DB::table('activities')->insert([
            'id' => '79200655-bc28-42a3-ac4b-030eba8cd5b8',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => '2cb47788-c907-4196-8960-9b26fa699ec4',
            'title' => 'September Flag Raising Ceremony',
            'location' => 'Via Zoom/Facebook Live',
            'start_datetime' => '2022-09-05 08:00:00',
            'end_datetime' => '2022-09-05 09:00:00',
            'description' => 'September Flag Raising Ceremony',
            'status' => 'Pending',
            'activity_type_id' => '9c7ea8df-50ff-4b0a-8efd-118a3d8baee5',
        ]);
    }
}
