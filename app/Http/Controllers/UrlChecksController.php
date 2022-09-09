<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DiDom\Document;

use DiDom\Exceptions\InvalidSelectorException;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UrlChecksController extends Controller
{
    public function store(int $id): RedirectResponse
    {
        $now = Carbon::now();
        try {
            $url = $this->getUrlName($id);
            $response = Http::get($url);
            $document = $this->getDocumentElement($response);

            $checkData = [
                'url_id' => $id,
                'status_code' => $response->status(),
                'h1' => $document['h1'],
                'title' => $document['title'],
                'description' => $document['description'],
                'created_at' => $now,
            ];
            DB::table('url_checks')->insert($checkData);

            flash('Страница успешно проверена')->success();
        } catch (Exception $exception) {
            flash($exception->getMessage())->error();
        }
        return redirect()->route('urls.show', $id);
    }


    private function getDocumentElement($response): array
    {
        $h1 = '';
        $title = '';
        $description = '';

        try {
            $document = new Document($response->body());
            if ($document->has('h1')) {
                $h1 = $document->find('h1')[0]->text();
            }

            if ($document->has('title')) {
                $title = $document->find('title')[0]->text();
            }

            if ($document->has('meta[name=description]')) {
                $description = $document
                    ->find('meta[name=description]')[0]
                    ->getAttribute('content');
            }
        } catch (InvalidSelectorException) {

        }

        return ['h1' => $h1, 'title' => $title, 'description' => $description];
    }

    private function getUrlName($id): string
    {
        $url = DB::table('urls')->find($id);
        if (!$url) {
            abort(404);
        }

        return $url->name;
    }
}
