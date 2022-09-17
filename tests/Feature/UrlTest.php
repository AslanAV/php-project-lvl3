<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlTest extends TestCase
{
    use RefreshDatabase;

    private array $body = [
        'url' => ['name' => 'https://www.example.com'],
    ];

    public function testIndexPage(): void
    {
        $response = $this->get(route('urls.index'));

        $response->assertOk();
    }

    public function testShowPage(): void
    {
        DB::table('urls')->insert([
            'name' => $this->body['url']['name'],
            'created_at' => Carbon::now(),
        ]);
        $newResponse = $this->get('/urls/1');
        $newResponse->assertOk();
    }

    public function testStore(): void
    {
        $response = $this->post(route('urls.store'), $this->body);
        $response->assertRedirect()->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', $this->body['url']);
    }
}
