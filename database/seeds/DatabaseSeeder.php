<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            RolesTableSeeder::class,
            UpicTableSeeder::class,
            UserTableSeeder::class,
            UserRolesTableSeeder::class,
            GistsTableSeeder::class
        ]);
    }
}
