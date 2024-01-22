<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotNull;

class MovieControllerTest extends TestCase
{
    /** @test */
    public function test_get_api_success()
    {
        $result = $this->get('/')->assertSeeText('Judul');
    }
    
}
