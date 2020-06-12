<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        
        'name' => $faker->name,
        'url' => 'http://127.0.0.1:8000/page1',
        'body' => $faker->text(),
    ];
});
