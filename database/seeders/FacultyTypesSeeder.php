<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacultyType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FacultyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\FacultyType::factory(10)->create();
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
    }
}
