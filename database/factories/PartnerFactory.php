<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    protected $model = Partner::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => collect(fake()->paragraphs(mt_rand(10, 50)))->implode(''),
            'stok'=>round(mt_rand(10000,100000),-3),
            'harga'=>round(mt_rand(1000,100000),-3),
            'alamat'=>fake()->address(),
            'user_id'=>mt_rand(1,3),
        ];
    }
}
