<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home = new Category();
        $home->name = 'root';
        $home->description = 'just the root';
        $home->advice = 'don\'t insert any item here';
        $home->save();

        $cars = new Category();
        $cars->name = 'Cars';
        $cars->description = 'New and Used cars for sale';
        $cars->advice = 'include full information about your car';
        $home->children()->save($cars);

        $homes = new Category();
        $homes->name = 'Homes';
        $homes->description = 'Homes for rental and sell';
        $homes->advice = 'include full information about your house';
        $home->children()->save($homes);

        $jobs = new Category();
        $jobs->name = 'Jobs';
        $jobs->description = 'Search for a nearby job';
        $jobs->advice = 'include full information about the job';
        $home->children()->save($jobs);
    }
}
