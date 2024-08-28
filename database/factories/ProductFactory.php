<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'desc' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'image' => 'images/' . $this->faker->image('public/images', 640, 480, null, false)
        ];
    }
}
