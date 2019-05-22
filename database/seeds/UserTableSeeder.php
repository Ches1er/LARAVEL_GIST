<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = Hash::make("1111");
        DB::table("users")->insert([
            [
                "name"=>"Admin",
                "email"=>"shop@ukrpolystroy.com.ua",
                "password"=>$pass,
                "upic_id"=>2,
                "email_verification_token"=>md5("Admin")
            ],
            [
                "name"=>"User",
                "email"=>"shop@ukrpolystroy.com.ua",
                "password"=>$pass,
                "upic_id"=>1,
                "email_verification_token"=>md5("User")
            ]
        ]);
    }
}
