<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'required_amount' => $this->faker->randomNumber(2),
            'total_per_product' => $this->faker->randomFloat(2,0,1000),
            'id_product'=>Product::factory(),
            'id_order'=>PurchaseOrder::factory(),
            'created_at' => $this->faker->date,
            'updated_at' => $this->faker->date,
        ];
    }
}
