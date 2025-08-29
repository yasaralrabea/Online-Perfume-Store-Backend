<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     * 
     */
    protected $model = Product::class; 
    public function definition(): array

    {
        $imageFiles = [
    'products/42b00800-4dd0-4043-8a59-3e3353bbf2ce.webp',
    'products/57b78620-d458-4d8a-aefd-4334f03650f0.webp',
    'products/68114f23-9df3-474a-8a2a-926940798a82.webp',
    'products/ab0c0067-f8d4-4f25-b294-13e79b16775a.jpg',
];

        return [
            'name' => $this->faker->words(2, true),
            'code' => $this->faker->numberBetween(250,3500),   
            'sex' => $this->faker->randomElement(['female', 'male']),
            'special' => $this->faker->randomElement(['yes', 'no']),
            'image' => $this->faker->randomElement($imageFiles),
            'number_of_sales' => $this->faker->numberBetween(0, 10000),
            'price' => $this->faker->randomFloat(2, 50, 300),  
            'description' => $this->faker->sentence(10),      
            'quantity' => $this->faker->numberBetween(0, 200),   
        ];
    }
}
