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
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => '3a5358f3-f0ab-4654-8cac-5c1282a81ff8',
        ]);
        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => 'b386fdb9-5197-4ac2-b198-6384323af036',
        ]);
        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => 'da39b66a-9fcb-405f-a79e-60defd788ea8',
        ]);
        DB::table('user_roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:33',
            'updated_at' => '2022-06-22 16:33:33',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'user_id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'role_id' => 'd2a81b5a-0228-48e2-8ccc-1a4820e26fa9',
        ]);
    }
}
