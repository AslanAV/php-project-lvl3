<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UrlChecksTest extends TestCase
{
    use RefreshDatabase;

    private string $url = 'https://www.azsgnk.ru';

    private string $html = '<meta name="description" content="description"><title>title</title><h1>h1</h1>';

    public function testCheckUrlSuccess(): void
    {
        Http::fake([
            $this->url => Http::response(
                $this->html,
            )
        ]);

        $id = DB::table('urls')->insertGetId([
            'name' => $this->url,
            'created_at' => Carbon::now(),
        ]);

        $checkData = [
            'url_id' => $id,
            'status_code' => 200,
            'h1' => 'h1',
            'title' => 'title',
            'description' => 'description',
            'created_at' => Carbon::now(),
        ];

        $checkResponse = $this->post(route('urls.checks.store', [$id]));
        $checkResponse->assertRedirect()->assertStatus(302);
        $checkResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('url_checks', $checkData);
    }
}
