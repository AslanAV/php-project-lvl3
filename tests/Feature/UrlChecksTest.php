<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UrlChecksTest extends TestCase
{
    private string $url;
    private int $id;

    public function setUp(): void
    {
        parent::setUp();

        $this->url = 'https://www.azsgnk.ru';
        $data = [
            'name' => $this->url,
            'created_at' => Carbon::now(),
        ];

        $this->id = DB::table('urls')->insertGetId($data);
    }

    public function testStore(): void
    {
        $path = __DIR__ . '/../Fixtures/index.html';
        $html = file_get_contents($path);
        if ($html === false) {
            throw new Exception("file path: {$path} - is incorrect");
        }

        Http::fake([
            $this->url => Http::response($html, 200)
        ]);

        $checkData = [
            'url_id' => $this->id,
            'status_code' => 200,
            'h1' => 'h1',
            'title' => 'title',
            'description' => 'description',
            'created_at' => Carbon::now(),
        ];

        $checkResponse = $this->post(route('urls.checks.store', $this->id));
        $checkResponse->assertRedirect()->assertStatus(302);
        $checkResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('url_checks', $checkData);
    }
}
