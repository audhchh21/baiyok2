<?php

use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('districts')->insert([
            [
                'name' => 'เมืองปราจีนบุรี',
                'province_id' => '1'
            ],
            [
                'name' => 'กบินทร์บุรี',
                'province_id' => '1'
            ],
            [
                'name' => 'นาดี',
                'province_id' => '1'
            ],
            [
                'name' => 'บ้านสร้าง',
                'province_id' => '1'
            ],
            [
                'name' => 'ประจันตคาม',
                'province_id' => '1'
            ],
            [
                'name' => 'ศรีมหาโพธิ',
                'province_id' => '1'
            ],
            [
                'name' => 'ศรีมโหสถ',
                'province_id' => '1'
            ]
        ]);
    }
}
