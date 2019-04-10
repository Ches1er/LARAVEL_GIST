<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("gists")->insert([["name"=>"PHP First project",
            "date"=>"123456784","category_id"=>1,
            "user_id"=>1,"desc"=>"My first PHP project"],
            ["name"=>"JS First project",
                "date"=>"123356784","category_id"=>2,
                "user_id"=>2,"desc"=>"My first JS project"]]);
    }
}
