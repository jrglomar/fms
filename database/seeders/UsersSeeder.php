<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'id' => 'b1fda120-82ae-49d3-811d-b3c9d5d747a1',
            'created_at' => '2022-06-22 16:25:03',
            'updated_at' => '2022-06-22 16:25:03',
            'email' => 'admin@pupqc.com',
            'password' => Hash::make('User01'),
            'status' => 'Active',
        ]);
    }
}
