<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductFetchTest extends TestCase
{
        use RefreshDatabase;

    /**
     * A basic unit test example.
     */
        /** @test */

    public function get_products_test(): void
    {
        Product::factory()->count(500)->create();

        $products=Product::all();
        $this->assertGreaterThanOrEqual(500, $products->count());
    }
}
