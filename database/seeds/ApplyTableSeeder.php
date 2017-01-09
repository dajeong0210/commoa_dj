<?php

use Illuminate\Database\Seeder;

class ApplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Apply::class, 40)->create();
    }
}
