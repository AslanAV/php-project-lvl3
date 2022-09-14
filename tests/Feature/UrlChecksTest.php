<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UrlChecksTest extends TestCase
{
    use RefreshDatabase;

    private array $body = [
        'url' => ['name' => 'https://www.azsgnk.ru'],
    ];

    private string $html = '<meta name="description" content="description"><title>title</title><h1>h1</h1>';

    public function testCheckUrlSuccess(): void
    {
        Http::fake([
            'https://www.azsgnk.ru' => Http::response(
                $this->html,
            )
        ]);

        $response = $this->post(route('urls.store'), $this->body);
        $response->assertRedirect()->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', $this->body['url']);

        $id = 1;
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
