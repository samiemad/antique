<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $active = new \App\Status();
        $active->name = 'active';
        $active->description = 'a normal functionning item';
        $active->save();

        $suspended = new \App\Status();
        $suspended->name = 'suspended';
        $suspended->description = 'a suspended item for violating terms of use';
        $suspended->save();
    }
}
