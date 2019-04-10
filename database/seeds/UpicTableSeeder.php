<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("upic")->insert([["path"=>"img/user.png"],
            ["path"=>"img/admin.png"]]);
    }
}
