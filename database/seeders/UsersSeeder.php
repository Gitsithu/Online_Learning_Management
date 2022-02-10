<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
       public function run()
        {
           //
           $objs = array(

            // default password is 'aaaaaaaa'
            ['id'=>'1', 'role_id' =>'1', 'name'=>'Admin', 'password' =>'$2y$10$KDarx27N4/WgKdW5TOspmOXdpxFQe8OJaeDPq1V0XSsXodrWBgB02','email' =>'admin@gmail.com', 'phone'=>'959','address'=>'ygn'],
            ['id'=>'2', 'role_id' =>'2', 'name'=>'Customer', 'password' =>'$2y$10$KDarx27N4/WgKdW5TOspmOXdpxFQe8OJaeDPq1V0XSsXodrWBgB02','email' =>'customer@gmail.com',  'phone'=>'959','address'=>'ygn'],


        );

        DB::table('users')->insert($objs);
        }

}
