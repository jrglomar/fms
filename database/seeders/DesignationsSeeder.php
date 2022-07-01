<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designation;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DesignationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Designation::factory(10)->create();
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
    }
}
