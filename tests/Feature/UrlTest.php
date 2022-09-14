<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UrlTest extends TestCase
{
    use RefreshDatabase;

    private array $body = [
        'url' => ['name' => 'https://www.example.com'],
    ];

    public function testMainPage(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    public function testIndexPage(): void
    {
        $response = $this->get('/urls');

        $response->assertOk();
    }

    public function testShowPage(): void
    {
        $response = $this->post('/urls', $this->body);
        $newResponse = $this->get('/urls/1');
        $newResponse->assertOk();
    }

    public function testAddUrlSuccess(): void
    {
        $response = $this->post('/urls', $this->body);
        $response->assertRedirect()->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', $this->body['url']);
    }
}
