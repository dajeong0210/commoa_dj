<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ApplyTableSeeder::class);
        $this->call(ShopTableSeeder::class);
        $this->call(CpuTableSeeder::class);
        $this->call(VgaTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);    
        $this->call(PivotTableSeeder::class);
    }
}
