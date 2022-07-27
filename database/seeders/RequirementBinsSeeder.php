<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequirementBin;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RequirementBinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requirement_bins')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-27 18:03:12',
            'updated_at' => '2022-06-27 18:03:12',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Final Requirement [ Project Plan ]',
            'description' => 'Project planning is the process of d',
            'deadline' => '2022-06-30 23:59:00',
            'status' => 'On Going'
        ]);
    }
}
