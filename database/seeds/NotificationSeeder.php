<?php

use Illuminate\Database\Seeder;
use App\Notification;
class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$no = new Notification();
    	$no->name = "no notifications";
    	$no->description = "gives no notifications at all";
    }
}
