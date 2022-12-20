<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => 1,
            'category_id' => $this->faker->numberBetween(1, 31),
            'label' => $this->faker->word(),
            'description' => $this->faker->words(6, true),
            'amount' => $this->faker->randomFloat(2, 0, 200),
            'date' => $this->faker->dateTimeBetween('-2 months')->format('Y-m-d'),
            'is_computed' => $this->faker->boolean(80),
        ];
    }
}
