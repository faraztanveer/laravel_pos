<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
DB::unprepared(file_get_contents('database/seeds/sql/insertCat.sql'));

        // $this->call(UsersTableSeeder::class);
    }
}
