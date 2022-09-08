<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlChecksController extends Controller
{
    public function store(int $id)
    {
        $now = Carbon::now();
        $checkData = [
            'url_id' => $id,
            'status_code' => 0,
            'h1' => 0,
            'title' => 0,
            'description' => 0,
            'created_at' => $now,
        ];

        DB::table('url_checks')->insert($checkData);
        $checksUrl = DB::table('url_checks')
            ->where('url_id', $id)
            ->orderByDesc('created_at')
            ->get();
        if (!$checksUrl) {
            abort(404);
        }

        $url = DB::table('urls')->find($id);
        flash('Страница успешно проверена')->success();
        return view('urls.show', compact('checksUrl','url'));

    }
}
