<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TitlenameSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(SubdistrictSeeder::class);
        $this->call(OfficeSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FoodsampleSeeder::class);
        $this->call(FoodsamplesourceSeeder::class);
        $this->call(FoodtestkitSeeder::class);

    }
}
