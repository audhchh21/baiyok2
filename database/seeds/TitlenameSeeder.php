<?php

use Illuminate\Database\Seeder;

class TitlenameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('titlenames')->insert([
            [
                'name' => 'นาย'
            ],[
                'name' => 'นาง'
            ],[
                'name' => 'นางสาว'
            ],[
                'name' => 'Mr.'
            ],[
                'name' => 'Mrs.'
            ]
        ]);
    }
}
