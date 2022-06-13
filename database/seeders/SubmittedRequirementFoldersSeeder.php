<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubmittedRequirementFoldersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SubmittedRequirementFolder::factory(10)->create();
    }
}
