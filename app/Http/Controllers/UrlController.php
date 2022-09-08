<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function index(): View
    {
        $urls = DB::table('urls')->orderBy('id')->paginate(10);
        $checksData = DB::table('url_checks')
            ->orderBy('url_id')
            ->latest()
            ->distinct('url_id')
            ->get()
            ->keyBy('url_id');
        $checksUrl = $checksData->all();
        return view('urls.index', compact('urls', 'checksUrl'));
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = Validator::make($request->all(), [
            'url.name' => 'url|required|max:255',
        ]);
        if ($validated->fails()) {
            flash('Некорректный URL')->error();
            return redirect()->route('home');
        }

        $nameUrl = $validated->getData()['url']['name'];
        $normalizeUrl = $this->normalizeUrl($nameUrl);

        $tryGetId = $this->hasId($normalizeUrl);
        if ($tryGetId) {
            flash('Страница уже существует')->success();
            return redirect()->route('urls.show', $tryGetId);
        }


        $id = DB::table('urls')->insertGetId([
            'name' => $normalizeUrl,
            'created_at' => Carbon::now(),
        ]);
        flash('Страница успешно добавлена')->success();
        return redirect()
            ->route('urls.show', $id);
    }

    public function show($id): View
    {
        $url = DB::table('urls')->find($id);
        if (!$url) {
            abort(404);
        }
        $checksUrl = DB::table('url_checks')
            ->where('url_id', $id)
            ->orderByDesc('created_at')
            ->get();
        if (!$checksUrl) {
            abort(404);
        }
        return view('urls.show', compact('url', 'checksUrl'));
    }

    private function hasId($name)
    {
        return DB::table('urls')->where('name', $name)->value('id');
    }

    private function normalizeUrl(string $nameUrl): string
    {
        $nameUrl = strtolower($nameUrl);
        $scheme = parse_url($nameUrl, PHP_URL_SCHEME);
        $host = parse_url($nameUrl, PHP_URL_HOST);

        return "{$scheme}://{$host}";
    }

}
