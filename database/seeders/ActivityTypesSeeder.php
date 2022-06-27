<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ActivityTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\ActivityType::factory(10)->create();
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
    }
}
