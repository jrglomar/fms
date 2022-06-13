<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeetingType;

class MeetingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MeetingType::factory(10)->create();
    }
}
