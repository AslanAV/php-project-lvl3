<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlTest extends TestCase
{
    private array $body;
    private int $id;

    protected function setUp(): void
    {
        parent::setUp();

        $this->body = ['url' => ['name' => 'https://www.example.com']];
        $data = [
            'name' => $this->body['url']['name'],
            'created_at' => Carbon::now(),
        ];

        $this->id = DB::table('urls')->insertGetId($data);
    }

    public function testIndexPage(): void
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testShowPage(): void
    {
        $response = $this->get(route('urls.show', compact($this->id)));
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
