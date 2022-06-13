<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RequirementListTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RequirementListType::factory(10)->create();
    }
}
