<?php

use Illuminate\Database\Seeder;
use App\Liketype;

class LiketypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $like = new Liketype();
        $like->name = 'Like';
        $like->save();

        $dislike = new Liketype();
        $dislike->name = 'Dislike';
        $dislike->save();
    }
}
