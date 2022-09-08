<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UrlChecksTest extends TestCase
{
    use RefreshDatabase; use WithoutMiddleware;

    private array $body = [
        'url' => ['name' => 'https://www.example.com'],
    ];

    public function testCheckUrlSuccess(): void
    {
        $response = $this->post('/urls', $this->body);
        $response->assertRedirect()->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', $this->body['url']);

        $id = 1;
        $checkData = [
            'url_id' => $id,
            'status_code' => 0,
            'h1' => 0,
            'title' => 0,
            'description' => 0,
            'created_at' => Carbon::now(),
        ];

        $checkResponse = $this->post('urls/1/checks', [$id]);
        $checkResponse->assertOk();
        $checkResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('url_checks', $checkData);
    }
}
