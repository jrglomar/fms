<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(AcademicRanksSeeder::class);
        $this->call(DesignationsSeeder::class);
        $this->call(FacultyTypesSeeder::class);
        $this->call(FacultiesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(ObservationsSeeder::class);
    }
}
