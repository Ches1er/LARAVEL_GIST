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
                "email"=>"admin@admin.com",
                "password"=>$pass,
                "upic_id"=>2
            ],
            [
                "name"=>"User",
                "email"=>"user@user.com",
                "password"=>$pass,
                "upic_id"=>1
            ]
        ]);
    }
}
