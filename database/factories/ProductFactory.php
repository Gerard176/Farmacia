<?php

namespace Database\Factories;

use App\models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'stock' => $this->faker->randomNumber(2),
            'unit_price' => $this->faker->randomFloat(2, 0, 1000),
            'category' => $this->faker->word,
            'id_supplier' => Supplier::factory(),
            'due_date' => $this->faker->date,
            'image'=> $this->faker->imageUrl,
            'status'=> $this->faker->numberBetween(0,1),
            'registerby'=> $this->faker->numberBetween(0,1),
            'created_at' => $this->faker->date,
            'updated_at' => $this->faker->date,
        ];
    }
}
