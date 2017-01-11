<?php

use Illuminate\Database\Seeder;

class PivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $shop_ids = App\Shop::all()->pluck('id')->toArray();
        $product_ids = App\Product::all()->pluck('id')->toArray();
        $category_ids = App\Category::all()->pluck('id')->toArray();

        // factory(App\User::class, 50)->create()->each(function ($user) {
        //     // $user->shops()->save(factory(App\Shop::class)->make());
        //     $user->shops()->attach($faker->randomElements($shop_ids, rand(0, 10)));
        //     $user->products()->attach($faker->randomElements($product_ids, rand(0, 20)));
        // });
        
        foreach (App\User::all() as $user) {
            $user->shops()->attach($faker->randomElements($shop_ids, rand(0, 10)));
            $user->products()->attach($faker->randomElements($product_ids, rand(0, 20)));
        } 

        foreach (App\Product::all() as $product) {
            $product->categories()->attach($faker->randomElements($category_ids, rand(0, 5)));
        }
    }

}
