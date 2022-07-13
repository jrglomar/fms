<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FacultiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Faculty::factory(10)->create();
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
            'image' => 'images/faculty_images/4f3e4b88313e821b0876f52c864be226.png'
        ]);
    }
}
