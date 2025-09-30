<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarttControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
        ]);

        $response = $this->withSession(['name' => $product->name])
                         ->get('/cart/add/{id}'); 
        
        $this->assertSessionHas('cart', function ($cart) use ($product) {
            return isset($cart[$product->id]);
        });


        $response->assertStatus(302);
    }
}
