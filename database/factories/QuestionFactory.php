<?php

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5, 8)), "."),
        'slug' => str_slug($faker->sentence(rand(1, 2))),
        'body' => $faker->paragraphs(rand(1, 3), true),
        'views' => rand(10, 15),
        //'answers_count' => rand(10, 15),
        'votes' => rand(-5, 10),
        'user_id' => 1
    ];
});