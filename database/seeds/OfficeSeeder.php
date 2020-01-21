<?php

use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('offices')->insert([
            [
                'name' => 'รพสต.เนินหอม',
                'address' => '123',
                'subdistrict' => 11,
                'district' => 1,
                'province' => 1
            ],[
                'name' => 'รพสต.โคกไม้ลาย',
                'address' => '233/555',
                'subdistrict' => 9,
                'district' => 1,
                'province' => 1
            ],[
                'name' => 'รพสต.บ้านพระ',
                'address' => '888/239',
                'subdistrict' => 8,
                'district' => 1,
                'province' => 1
            ],[
                'name' => 'รพสต.ดงขี้เหล็ก',
                'address' => '999/1',
                'subdistrict' => 10,
                'district' => 1,
                'province' => 1
            ],[
                'name' => 'รพสต.ดงพระราม',
                'address' => '444/22',
                'subdistrict' => 7,
                'district' => 1,
                'province' => 1
            ]
        ]);
    }
}
