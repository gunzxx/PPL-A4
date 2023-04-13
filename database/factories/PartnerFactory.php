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
            'name' => fake()->sentence(3,true),
            'description' => collect(fake()->paragraphs(mt_rand(10, 50)))->implode(''),
            'stok'=>mt_rand(10000,100000),
            'harga'=>mt_rand(1000,100000),
            'alamat'=>fake()->streetAddress(),
            'user_id'=>mt_rand(1,3),
        ];
    }
}
