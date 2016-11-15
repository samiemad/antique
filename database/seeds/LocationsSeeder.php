<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sy = new Location();
        $sy->name = 'Syria';
        $sy->main = true;
        $sy.save();

        $damas = new Location();
        $damas->name = 'Damascus';
        $damas->main = true;
        $sy->children()-save($damas);

        $latakia = new Location();
        $latakia->name = 'Latakia';
        $latakia->main = true;
        $latakia->children()-save($latakia);

        $tartus = new Location();
        $tartus->name = 'Tartus';
        $tartus->main = true;
        $tartus->children()-save($tartus);


    }
}
