<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $decade = $this->faker->dateTimeThisDecade(); // 過去10年分の日付を作成
        $created_at = $decade->modify('+2 years');    // 作成した過去10年分の日付に +2年した日付を作成
        return [
            'customer_id' => rand(1, Customer::count()),
            'status'      => $this->faker->boolean(),
            'created_at' => $created_at
        ];
    }
}
