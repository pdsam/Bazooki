<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Auction;
use App\Bazooker;
use Faker\Generator as Faker;

$factory->define(Auction::class, function (Faker $faker) {
    return [
        'owner' => Bazooker::all()->random(1)[0]->id,
        'base_bid' => (rand() % 200 + 100),
        'start_time' => $faker->dateTimeBetween('-10 days', '+1 day'),
        'duration' => (3600 * 1.5 + 3600 * 24 * (rand()%10)),
        'item_name' => 'name',
        'item_description' => 'desc',
        'item_short_description' => 'short desc'
    ];
});
