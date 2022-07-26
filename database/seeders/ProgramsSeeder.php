<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Program::factory(10)->create();
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
    }
}
