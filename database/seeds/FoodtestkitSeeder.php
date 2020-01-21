<?php

use Illuminate\Database\Seeder;

class FoodtestkitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foodtestkits')->insert([
            [
                'name' => 'ยาฆ่าแมลง'
            ],[
                'name' => 'บอแร็กซ์'
            ],[
                'name' => 'ฟอร์มาลีน'
            ],[
                'name' => 'สารกันรา'
            ],[
                'name' => 'สารฟอกขาว'
            ]
        ]);
    }
}
