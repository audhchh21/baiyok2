<?php

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shops')->insert([
            [
                'name' => 'ร้านคุณวรรณ',
                'titlename_id' => 2,
                'f_name' => 'วรรณี',
                'l_name' => 'แสงสุวรรณ',
                'address' => '248/1',
                'subdistrict' => 9,
                'district' => 1,
                'province' => 1,
                'tel' => '0881112233',
            ],[
                'name' => 'ร้านประเสริฐทรัพย์',
                'titlename_id' => 1,
                'f_name' => 'ประเสริฐ',
                'l_name' => 'โชคดี',
                'address' => '44/5',
                'subdistrict' => 9,
                'district' => 1,
                'province' => 1,
                'tel' => '0899992999'
            ],[
                'name' => 'ร้านเจ้ดาผักสด',
                'titlename_id' => 2,
                'f_name' => 'ดาวิกา',
                'l_name' => 'ดาราราย',
                'address' => '92',
                'subdistrict' => 9,
                'district' => 1,
                'province' => 1,
                'tel' => '0801112222'
            ],[
                'name' => 'ร้านนางน้อย',
                'titlename_id' => 2,
                'f_name' => 'นวลนาง',
                'l_name' => 'ดีแก้ว',
                'address' => '357/123',
                'subdistrict' => 9,
                'district' => 1,
                'province' => 1,
                'tel' => '0967775545'
            ],[
                'name' => 'ร้านเจ้แตง',
                'titlename_id' => 2,
                'f_name' => 'สโรชา',
                'l_name' => 'ยาใจ',
                'address' => '54/12',
                'subdistrict' => 9,
                'district' => 1,
                'province' => 1,
                'tel' => '0699999889'
            ]
        ]);
    }
}
