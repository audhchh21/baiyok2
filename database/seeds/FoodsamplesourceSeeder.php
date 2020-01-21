<?php

use Illuminate\Database\Seeder;

class FoodsamplesourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foodsamplesources')->insert([
            [
                'name' => 'ตลาดไท'
            ],[
                'name' => 'ตลาดหน้ารถไฟ'
            ],[
                'name' => 'ตลาดใหญ่'
            ],[
                'name' => 'สวนยายแดง'
            ],[
                'name' => 'สวนคุณฟ้า'
            ]
        ]);
    }
}
