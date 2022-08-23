<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreurlsRequest;
use App\Http\Requests\UpdateurlsRequest;
use App\Models\urls;

class UrlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreurlsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreurlsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\urls  $urls
     * @return \Illuminate\Http\Response
     */
    public function show(urls $urls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\urls  $urls
     * @return \Illuminate\Http\Response
     */
    public function edit(urls $urls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateurlsRequest  $request
     * @param  \App\Models\urls  $urls
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateurlsRequest $request, urls $urls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\urls  $urls
     * @return \Illuminate\Http\Response
     */
    public function destroy(urls $urls)
    {
        //
    }
}
