<?php

use App\User;
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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        // 'permission' => $faker->numberBetween(0, 2),
        'permission' => 0, 
    ];
});

// $factory->define(App\Shop::class, function (Faker\Generator $faker) {
//     $user_id = App\User::pluck('id')->toArray();

//     return [
//         'name' => $faker->company,
//         'image' => $faker->imageUrl($width = 640, $height = 480),
//         'url' => $faker->unique()->url,
//         'contact_address' => $faker->unique()->address,
//         'contact_name' => $faker->name,
//         'contact_phone' => $faker->unique()->tollFreePhoneNumber,
//         'contact_mobile' => $faker->unique()->tollFreePhoneNumber,
//         'contact_email' => $faker->unique()->email,
//         'user_id' => $faker->randomElement($user_id),
//     ];
// });

$factory->define(App\Cpu::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'brand' => $faker->company,
        'level' => $faker->randomElement($array = array (1, 2, 3)),
        'cores' => $faker->randomElement($array = array (1, 2, 3, 4, 6, 8, 10, 12, 14, 16, 18)),
    ];
});

$factory->define(App\Vga::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'brand' => $faker->company,
        'level' => $faker->randomElement($array = array (1, 2, 3)),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

// $factory->define(App\Product::class, function (Faker\Generator $faker) {
//     $cpu_id = App\Cpu::pluck('id')->toArray();
//     $vga_id = App\Vga::pluck('id')->toArray();
//     $shop_id = App\Shop::pluck('id')->toArray();

//     return [
//         'name' => $faker->name,
//         'image' => $faker->imageUrl($width = 640, $height = 480),
//         'url' => $faker->unique()->url,
//         'price' => $faker->numberBetween($min = 100000, $max = 500000),
//         'os' => $faker->numberBetween(0, 1),
//         'ram' => $faker->randomElement($array = array (2, 4, 8, 16, 32)),
//         'ssd' => $faker->randomElement($array = array (120, 128, 256, 512)),
//         'hdd' => $faker->randomElement($array = array (500, 1000, 2000)),
//         'overclock' => $faker->numberBetween(0, 1),
//         'power' => $faker->randomElement($array = array (600, 700, 800, 900, 1000)),
//         'monitor' => $faker->numberBetween(18, 32),
//         'views' => $faker->numberBetween(0, 1000),
//         'cpu_id' => $faker->randomElement($cpu_id),
//         'vga_id' => $faker->randomElement($vga_id),
//         'shop_id' => $faker->randomElement($shop_id),
//         'recommend' => 0,
//     ];
// });

// $factory->define(App\Apply::class, function (Faker\Generator $faker) {
//     // $user_email = App\User::pluck('email')->toArray();
//     $user_id = App\User::pluck('id')->toArray();
//     $faker_id = $faker->randomElement($user_id);

//     return [
//         'user_id' => $faker_id,
//         'user_email' => User::find($faker_id)->email,
//         'shop_name' => $faker->company,
//         'shop_url' => $faker->unique()->url,
//         'business_name' => $faker->company,
//         'business_ceo' => $faker->name,
//         'business_address' => $faker->unique()->address,
//         'business_no' => $faker->creditCardNumber,
//         'business_sale_no' => $faker->swiftBicNumber,
//         'business_docu' => $faker->imageUrl($width = 640, $height = 480),
//         'sale_docu' => $faker->imageUrl($width = 640, $height = 480),
//         'contact_name' => $faker->name,
//         'contact_email' => $faker->email,
//         'contact_mobile' => $faker->tollFreePhoneNumber,
//         'contact_phone' => $faker->tollFreePhoneNumber,
//         'permission' => $faker->numberBetween(0, 1),
//     ];
// });