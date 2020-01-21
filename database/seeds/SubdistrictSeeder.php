<?php

use Illuminate\Database\Seeder;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('subdistricts')->insert([
            [
                'name' => 'หน้าเมือง',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'รอบเมือง',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'วัดโบสถ์',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'บางเดชะ',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'ท่างาม',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'บางบริบูรณ์',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'ดงพระราม',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'บ้านพระ',
                'zip_code' => 25230,
                'district_id' => 1
            ],[
                'name' => 'โคกไม้ลาย',
                'zip_code' => 25230,
                'district_id' => 1
            ],[
                'name' => 'ดงขี้เหล็ก',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'เนินหอม',
                'zip_code' => 25230,
                'district_id' => 1
            ],[
                'name' => 'โนนห้อม',
                'zip_code' => 25000,
                'district_id' => 1
            ],[
                'name' => 'กบินทร์',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'เมืองเก่า',
                'zip_code' => 25240,
                'district_id' => 2
            ],[
                'name' => 'วังดาล',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'นนทรี',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'ย่านรี',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'วังตะเคียน',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'หาดนางแก้ว',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'ลาดตะเคียน',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'บ้านนา',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'บ่อทอง',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'หนองกี่',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'นาแขม',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'เขาไม้แก้ว',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'วังท่าช้าง',
                'zip_code' => 25110,
                'district_id' => 2
            ],[
                'name' => 'นาดี',
                'zip_code' => 25220,
                'district_id' => 3
            ],[
                'name' => 'สำพันตา',
                'zip_code' => 25220,
                'district_id' => 3
            ],[
                'name' => 'สะพานหิน',
                'zip_code' => 25220,
                'district_id' => 3
            ],[
                'name' => 'ทุ่งโพธิ์',
                'zip_code' => 25220,
                'district_id' => 3
            ],[
                'name' => 'แก่งดินสอ',
                'zip_code' => 25220,
                'district_id' => 3
            ],[
                'name' => 'บุพราหมณ์',
                'zip_code' => 25220,
                'district_id' => 3
            ],[
                'name' => 'บ้านสร้าง',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'บางกระเบา',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'บางเตย',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'บางยาง',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'บางแตน',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'บางพลวง',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'บางปลาร้า',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'บางขาม',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'กระทุ่มแพ้ว',
                'zip_code' => 25150,
                'district_id' => 4
            ],[
                'name' => 'ประจันตคาม',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'เกาะลอย',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'บ้านหอย',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'หนองแสง',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'ดงบัง',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'คำโตนด',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'บุฝ้าย',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'หนองแก้ว',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'โพธิ์งาม',
                'zip_code' => 25130,
                'district_id' => 5
            ],[
                'name' => 'ศรีมหาโพธิ',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'สัมพันธ์',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'บ้านทาม',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'ท่าตูม',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'บางกุ้ง',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'ดงกระทงยาม',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'หนองโพรง',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'หัวหว้า',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'หาดยาง',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'กรอกสมบูรณ์',
                'zip_code' => 25140,
                'district_id' => 6
            ],[
                'name' => 'โคกปีบ',
                'zip_code' => 25190,
                'district_id' => 7
            ],[
                'name' => 'โคกไทย',
                'zip_code' => 25190,
                'district_id' => 7
            ],[
                'name' => 'คู้ลำพัน',
                'zip_code' => 25190,
                'district_id' => 7
            ],[
                'name' => 'ไผ่ชะเลือด',
                'zip_code' => 25190,
                'district_id' => 7
            ]
        ]);
    }
}
