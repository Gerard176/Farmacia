<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_date' => $this->faker->date,
            'delivery_date' => $this->faker->date,
            'order_price'=>$this->faker->randomFloat(2,0,1000),
            'factura'=> $this->faker->imageUrl,
            'status'=> $this->faker->numberBetween(0,1),
            'id_user'=> OrderDetail::factory(),
            'created_at' => $this->faker->date,
            'updated_at' => $this->faker->date,
            
        ];
    }
}
