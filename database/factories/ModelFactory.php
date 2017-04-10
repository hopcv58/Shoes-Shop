<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Faker\Generator;
use App\Responsitory\Advertisments;
use App\Responsitory\Products;
use App\Responsitory\Categories;
use App\Responsitory\productcate;
use App\Responsitory\Customers;
use App\Responsitory\Feedbacks;
use App\Responsitory\News;
use App\Responsitory\Comments;
use App\Responsitory\Orders;
use App\Responsitory\productOrder;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
		'img' => $faker->sentence,
        'remember_token' => str_random(10),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});

$factory->define(Advertisments::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'detail' => $faker->sentence,
        'start_date' => $faker->date('Y-m-d'),
        'end_date' => $faker->date('Y-m-d'),
        'discount' => $faker->numberBetween(0,90),
    ];
});

$factory->define(Products::class, function (Generator $faker){
   return [
       'name' => $faker->name,
       'code' => $faker->currencyCode,
       'description' => $faker->paragraph,
       'price' => $faker->numberBetween(100,1000),
       'ad_id' => $faker->numberBetween(1,10),
       'attribute' => $faker->sentence,
       'img_profile' => $faker->sentence,
       'img' => $faker->sentence,
       'is_public' => $faker->numberBetween(0,1),
   ] ;
});

$factory->define(Categories::class, function (Generator $faker) {
   return [
       'name' => $faker->name,
       'parent_id' => 0,
       'is_public' => $faker->numberBetween(0,1),
       'alias' => $faker->sentence,
       'description' => $faker->paragraph,
   ] ;
});

$factory->define(productcate::class, function (Generator $faker) {
   return [
       'product_id' => $faker->numberBetween(1,100),
       'cate_id' => $faker->numberBetween(1,10),
   ];
});

$factory->define(Customers::class, function(Generator $faker) {
   return [
       'username' => $faker->unique()->name,
       'password' => bcrypt('123456'),
       'email' => $faker->unique()->safeEmail,
       'address' => $faker->address,
       'phone' => $faker->phoneNumber,
   ];
});

$factory->define(Feedbacks::class, function (Generator $faker) {
   return [
       'content' => $faker->paragraph,
       'is_public' => $faker->numberBetween(0,1),
       'username' => $faker->name,
       'email' => $faker->safeEmail,
       'phone' => $faker->phoneNumber,
       'customer_id' => $faker->numberBetween(1,10),
   ];
});

$factory->define(News::class, function (Generator $faker) {
   return [
       'title' => $faker->sentence,
       'content' => $faker->paragraph,
       'summary' => $faker->sentence,
       'img' => $faker->sentence,
       'is_public' => $faker->numberBetween(0,1),
   ];
});

$factory->define(Comments::class, function (Generator $faker){
   return [
       'customer_id' => $faker->numberBetween(1,10),
       'content' => $faker->paragraph,
       'commentable_id' => $faker->numberBetween(1,100),
       'commentable_type' => $faker->randomElement(['App\Responsitory\News', 'App\Responsitory\Products']),
   ];
});

$factory->define(Orders::class, function (Generator $faker){
    return [
        'name' => $faker->name,
        'code' => $faker->postcode,
        'description' => $faker->sentence,
        'status' => $faker->numberBetween(0,1),
        'total' => $faker->numberBetween(1000,2000),
        'payment' => $faker->randomElement(['free ship', 'paypal']),
        'payment_info' => $faker->sentence,
        'note' => $faker->sentence,
        'customer_id' => $faker->numberBetween(1,10),
        'username' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});

$factory->define(productOrder::class, function (Generator $faker) {
   return [
       'product_id' => $faker->numberBetween(1,10),
       'order_id' => $faker->numberBetween(1,10),
       'qty' => $faker->numberBetween(1,10),
       'amount' => $faker->numberBetween(100,1000),
       'status' => $faker->numberBetween(0,1),
   ];
});