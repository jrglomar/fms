<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\UserRole::factory(10)->create();
        DB::table('user_roles')->insert([
            'id' => '72a1a0be-8ef8-47fb-b5fa-6eb84097162e',
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => '3a5358f3-f0ab-4654-8cac-5c1282a81ff8',
        ]);
    }
}
