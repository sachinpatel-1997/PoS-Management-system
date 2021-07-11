<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('admins')->delete();
        $adminRecords = [
            ['id'=>1,'usertype'=>'Admin','name'=>'admin','email'=>'sach1997pat@gmail.com','password'=>Hash::make('12345678'),'mobile'=>'7567818692','address'=>'a/8 Akshardeep Tenament','gender'=>'Male','image'=>'','status'=>1],
        
        ];

        DB::table('admins')->insert($adminRecords);

  //      foreach ($adminRecords as $key => $record) {
    //        \App\Admin::create($record);
      //  }
    }
    }

