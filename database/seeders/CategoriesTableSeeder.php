<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => '大学の課題'],
            ['name' => '日ごろの悩み'],
            ['name' => '就活のアドバイス'],
        ]);
    }
}
