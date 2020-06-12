<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nbUsers = (int)$this->command->ask("How many of user you want generate ?", 10);

        factory(App\Comment::class,  $nbUsers)->create(); 
    }
}
