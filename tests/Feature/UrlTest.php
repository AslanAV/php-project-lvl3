<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlTest extends TestCase
{
    private int $id;

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
        $data = ['url' => ['name' => 'https://www.example.ru']];
        $response = $this->post(route('urls.store'), $data);
        $response->assertRedirect()->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', $data['url']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $data = [
            'name' => 'https://www.azsgnk.ru',
            'created_at' => Carbon::now(),
        ];

        $this->id = DB::table('urls')->insertGetId($data);
    }
}
