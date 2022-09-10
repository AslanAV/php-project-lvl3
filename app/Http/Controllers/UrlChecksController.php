<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DiDom\Document;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UrlChecksController extends Controller
{
    public function store(int $id): RedirectResponse
    {
        try {
            $url = $this->getUrlName($id);
            $response = Http::get($url);
            $document = new Document($response->body());

            $checkData = [
                'url_id' => $id,
                'status_code' => $response->status(),
                'h1' => optional($document->find('h1')[0])->text(),
                'title' => optional($document->find('title')[0])->text(),
                'description' => $document->find('meta[name=description]')[0]->getAttribute('content'),
                'created_at' => Carbon::now(),
            ];
            DB::table('url_checks')->insert($checkData);

            flash('Страница успешно проверена')->success();
        } catch (Exception $exception) {
            flash($exception->getMessage())->error();
        }
        return redirect()->route('urls.show', $id);
    }

    private function getUrlName(int $id): string
    {
        $url = DB::table('urls')->find($id);
        if (!$url) {
            abort(404);
        }

        return $url->name;
    }
}
