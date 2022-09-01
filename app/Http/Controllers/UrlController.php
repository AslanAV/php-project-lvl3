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
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(): Factory|View|Application
    {
        $urls = DB::table('urls')->orderBy('id')->paginate(10);
        return view('urls.index', compact('urls'));
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = Validator::make($request->all(), [
            'url.name' => 'required|max:255',
        ]);
        if ($validated->fails()) {
            flash('Некорректный URL')->error();
            return redirect()->route('home');
        }

        $nameUrl = $validated->getData()['url']['name'];
        $now = Carbon::now();

        $tryGetId = $this->hasId($nameUrl);
        if ($tryGetId) {
            flash('Страница уже существует')->success();
            return redirect()->route('urls.show', $tryGetId);
        }


        $id = DB::table('urls')->insertGetId([
            'name' => $nameUrl,
            'created_at' => $now,
        ]);
        flash('Страница успешно добавлена')->success();
        return redirect()
            ->route('urls.show', $id);
    }

    private function hasId($name)
    {
        return DB::table('urls')->where('name', $name)->value('id');
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
