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
        $tableUrls = [
            'https://hexlet.io',
            'https://code-basics.com',
            'https://todoist.com',
            'https://laravel.com',
            'https://example.com',
            'https://symfony.com',
            'https://ubuntu.com/',
            'https://www.spacex.com',
            'https://hubblesite.org',
            'https://www.nasa.gov',
            'https://jwst.nasa.gov',
            'https://www.coca-cola.ru',
            'https://ru.jbl.com',
            'https://www.citilink.ru',
            'https://www.dns-shop.ru',
            'https://bashorg.org',
        ];

        foreach ($tableUrls as $key => $url) {
            DB::table('urls')->insert([
                'name' => $url,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
