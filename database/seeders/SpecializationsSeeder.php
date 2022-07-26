<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\specialization::factory(10)->create();
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
    }
}
