<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roleAdmin = \App\Role::where('name','admin')->first();
    	$roleModerator = \App\Role::where('name','moderator')->first();
    	$roleUser = \App\Role::where('name','user')->first();

        $admin = new \App\User();
        $admin->name = 'admin';
        $admin->email = 'admin@antique.com';
        $admin->password = bcrypt('admin11');

        $loc = \App\Location::whereNull('parent_id')->where('main','1')->first();

        $admin->location()->associate($loc);

        $admin->save();
        $admin->roles()->attach($roleAdmin);

        $user = new \App\User();
        $user->name = 'user';
        $user->email = 'user@antique.com';
        $user->password = bcrypt('user11');

        $user->location_id = $loc->id;

        $user->referrer_id = $admin->id;

        $user->save();
        $user->roles()->attach($roleUser);

        $moderator = new \App\User();
        $moderator->name = 'moderator';
        $moderator->email = 'moderator@antique.com';
        $moderator->password = bcrypt('moderator11');

        $moderator->location_id = $loc->id;

        $moderator->referrer()->associate($admin);

        $moderator->save();
        $moderator->roles()->attach($roleModerator);
    }
}
