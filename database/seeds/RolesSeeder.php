<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->description = 'admin';
        $admin->save();

        $moderator = new Role();
        $moderator->name = 'moderator';
        $moderator->description = 'moderator';
        $moderator->save();

        $user = new Role();
        $user->name = 'user';
        $user->description = 'user';
        $user->save();
    }
}
