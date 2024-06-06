<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
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
            'adress'=>$this->faker->word,   
            'phone'=> $this->faker->randomNumber(2),
            'email' => fake()->unique()->safeEmail(),
            'description' => $this->faker->sentence,
            'created_at'=> $this->faker->date,
            'updated_at'=> $this->faker->date,
            'image'=> $this->faker->imageUrl,
            'status'=> $this->faker->numberBetween(0,1),
            'registerby'=> $this->faker->numberBetween(0,1),
        ];
    }
}
