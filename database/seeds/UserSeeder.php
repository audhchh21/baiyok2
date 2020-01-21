<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        DB::table('users')->insert([
            [
                'titlename_id' => 2,
                'office_id' => 1,
                'f_name' => 'ภัสสภร',
                'l_name' => 'มูลดี',
                'email' => 'admin1'.'@gmail.com',
                'phone' => '0881112233',
                'password' => bcrypt('password'),
                'type' => 'Admin',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'titlename_id' => 1,
                'office_id' => 2,
                'f_name' => 'สหพันธ์',
                'l_name' => 'ดอนเส',
                'email' => 'admin2'.'@gmail.com',
                'phone' => '0899992999',
                'password' => bcrypt('password'),
                'type' => 'Admin',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'titlename_id' => 2,
                'office_id' => 1,
                'f_name' => 'ธมลวรรณ',
                'l_name' => 'อี้ฟาน',
                'email' => 'manager'.'@gmail.com',
                'phone' => '0801112233',
                'password' => bcrypt('password'),
                'type' => 'Manager',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'titlename_id' => 1,
                'office_id' => 3,
                'f_name' => 'รัชชานนท์',
                'l_name' => 'พลเดชา',
                'email' => 'member1'.'@gmail.com',
                'phone' => '0801112222',
                'password' => bcrypt('password'),
                'type' => 'User',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'titlename_id' => 2,
                'office_id' => 3,
                'f_name' => 'จันทิกา',
                'l_name' => 'เสริมรัมย์',
                'email' => 'member2'.'@gmail.com',
                'phone' => '0699999889',
                'password' => bcrypt('password'),
                'type' => 'User',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'titlename_id' => 2,
                'office_id' => 2,
                'f_name' => 'หยกหยก',
                'l_name' => 'เองจร้า',
                'email' => 'member3'.'@gmail.com',
                'phone' => '0699999822',
                'password' => bcrypt('password'),
                'type' => 'User',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
