<?php

use Illuminate\Database\Seeder;

class FoodsampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foodsamples')->insert([
            [
                'name' => 'ผักกาดขาว',
                'category' => 'ผักสด'
            ],[
                'name' => 'ผักคะน้า',
                'category' => 'ผักสด'
            ],[
                'name' => 'กุ้งสด',
                'category' => 'ของสด'
            ],[
                'name' => 'ลูกชิ้นหมู',
                'category' => 'อาหารแปรรูป'
            ],[
                'name' => 'หน่อไม้',
                'category' => 'ของหมักดอง'
            ]
        ]);
    }
}
