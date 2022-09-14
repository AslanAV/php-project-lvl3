<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class MainPageTest extends TestCase
{
    public function testMainPage(): void
    {
        $response = $this->get(route('main'));

        $response->assertOk();
    }
}
