<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlTest extends TestCase
{
    use RefreshDatabase;

    private array $body;
    private array $id;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->body = ['url' => ['name' => 'https://www.example.com']];
        $this->data = [
            'name' => $this->body['url']['name'],
            'created_at' => Carbon::now(),
        ];
        $id = DB::table('urls')->insertGetId($this->data);
        $this->id = ['url' => $id];
    }

    public function testIndexPage(): void
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testShowPage(): void
    {
        $response = $this->get(route('urls.show', $this->id));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this->post(route('urls.store', $this->body));
        $response->assertRedirect()->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', $this->body['url']);
    }
}
