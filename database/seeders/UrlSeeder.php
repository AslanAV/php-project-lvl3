<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('urls')->insert([
            ['name' => 'https://hexlet.io', 'created_at' => Carbon::now()],
            ['name' => 'https://code-basics.com', 'created_at' => Carbon::now()],
            ['name' => 'https://todoist.com', 'created_at' => Carbon::now()],
            ['name' => 'https://laravel.com', 'created_at' => Carbon::now()],
            ['name' => 'https://example.com', 'created_at' => Carbon::now()],
            ['name' => 'https://symfony.com', 'created_at' => Carbon::now()],
            ['name' => 'https://ubuntu.com/', 'created_at' => Carbon::now()],
            ['name' => 'https://www.spacex.com', 'created_at' => Carbon::now()],
            ['name' => 'https://hubblesite.org', 'created_at' => Carbon::now()],
            ['name' => 'https://www.nasa.gov', 'created_at' => Carbon::now()],
            ['name' => 'https://jwst.nasa.gov', 'created_at' => Carbon::now()],
            ['name' => 'https://www.coca-cola.ru', 'created_at' => Carbon::now()],
            ['name' => 'https://ru.jbl.com', 'created_at' => Carbon::now()],
            ['name' => 'https://www.citilink.ru', 'created_at' => Carbon::now()],
            ['name' => 'https://www.dns-shop.ru', 'created_at' => Carbon::now()],
            ['name' => 'https://bashorg.org', 'created_at' => Carbon::now()],
        ]);
    }
}
