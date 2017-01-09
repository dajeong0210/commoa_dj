<?php

use Illuminate\Database\Seeder;

class VgaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vga::class, 5)->create();
    }
}
