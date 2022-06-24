<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Role::factory(15)->create();

        DB::table('roles')->insert([
            'id' => '3a5358f3-f0ab-4654-8cac-5c1282a81ff8',
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Faculty',
        ]);
        DB::table('roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Checker',
        ]);
        DB::table('roles')->insert([
            'id' => Str::uuid(),
            'created_at' => '2022-06-22 16:33:28',
            'updated_at' => '2022-06-22 16:33:28',
            'created_by' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'title' => 'Academic Head',
        ]);

    }
}
