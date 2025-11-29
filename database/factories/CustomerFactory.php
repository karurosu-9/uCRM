<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tel = str_replace('-', '', $this->faker->phoneNumber(),); // 電話番号のハイフンを削除
        $address = mb_substr($this->faker->address(), 9); // 住所に郵便番号まで入ってしまうので、郵便番号を削除

        return [
            'name' => $this->faker->name(),
            'kana' => $this->faker->firstName(),
            'tel' => $tel,
            'email' => $this->faker->unique()->safeEmail(),
            'postcode' => $this->faker->postcode(),
            'address' => $address,
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->numberBetween(0, 1),
            'memo' => $this->faker->realText(50),
        ];
    }
}
