<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AcademicRanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\AcademicRank::factory(10)->create();
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
    }
}
