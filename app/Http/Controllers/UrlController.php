<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    public function index(): Factory|View|Application
    {
        $urls = DB::table('urls')->orderBy('id')->paginate(15);
        return view('urls.index', compact('urls'));
    }

    public function store(StoreUrlRequest $request): RedirectResponse
    {
        $validated = \Validator::make($request->all(), [
            'url.name' => 'required|unique:urls,name|max:255',
        ]);
        $nameUrl = $validated->getData()['url']['name'];
        $now = Carbon::now();
        $id = DB::table('urls')->insertGetId([
            'name' => $nameUrl,
            'created_at' => $now,
        ]);

        flash('Страница успешно добавлена')->success();
        return redirect()
            ->route('urls.show', $id);
//            ->with('success', 'Страница уже существует');
    }

    public function show($id): View
    {
        $url = DB::table('urls')->find($id);

        if (!$url) {
            abort(404);
        }
        return view('urls.show', compact('url'));
    }


}
