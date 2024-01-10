<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>fake()->randomDigitNotNull,
            'customer_name'=> fake()->name,
            'customer_phone'=> fake()->phoneNumber,
            'customer_email'=>fake()->safeEmail(),
            'customer_country'=>fake()->country(),
            'customer_address'=> fake()->address(),
            'customer_zipcode'=> fake()->randomNumber($nbDigits = NULL),
            'customer_city'=>fake()->city(),
            'total'=>fake()->randomNumber($nbDigits = NULL),
            'subtotal'=>fake()->randomNumber($nbDigits = NULL),
            'payment_type'=> fake()->name(),
            'shipping_charge'=> 150,
            'order_id'=> fake()->randomNumber($nbDigits = NULL),
            'date'=> fake()->date(),
            'month'=>fake()->month(),
            'year'=>fake()->year(),
            'status'=>fake()->numberBetween($min = 0, $max = 7)
        ];
    }
}
