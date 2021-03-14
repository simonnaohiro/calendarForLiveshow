<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, 'first', function (Faker $faker) {
    return [
        'name'     => 'テスト太郎',
        'mail'     => 'hoge@example.com',
        'password' => bcrypt('test'),
    ];
});

$factory->define(User::class, 'second', function (Faker $faker) {
    return [
        'name'     => 'テスト花子',
        'mail'     => 'hogefuga@example.com',
        'password' => bcrypt('test'),
    ];
});