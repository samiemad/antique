<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesSeeder::class);
        $this->call(LiketypesSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(RolesSeeder::class);
    }
}
