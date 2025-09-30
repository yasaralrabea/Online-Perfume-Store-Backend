<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
        use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Product::factory()->count(500)->create();

        $response = $this->get('/products/male');

        $response->assertStatus(200);

    }
}
