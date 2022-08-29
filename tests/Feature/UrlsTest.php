<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlsTest extends TestCase
{
    use RefreshDatabase;

    public function testMainPage(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    public function testPageUrls(): void
    {
        $response = $this->get('/urls');

        $response->assertOk();
    }

//    public function testAddUrlSuccess(): void
//    {
//        $body = [
//          'name' => 'http://www.example.com'
//        ];
//
//        $response = $this->post('urls.store', $body);
//
//        $response->assertRedirect();
//
//        $this->assertDatabaseHas('posts', $body);
//    }
}
