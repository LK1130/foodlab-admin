<?php

namespace Database\Factories;

use App\Models\OrderTransactionCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderTransactionCheckFactory extends Factory
{
     protected $model = T_AD_Order::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id'=> 41,
            'payment' =>$this->faker->randomDigit(),
            'township_id' => $this->faker->randomDigit(),
            'grandtotal_coin' => $this->faker->numerify('####'),
            'grandtotal_cash' => $this->faker->numerify('####'),
            'order_status' => $this->faker->randomDigitNot(0,8,9),
            'order_date' =>$this->faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now'),
            'order_time' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'last_control_by' => 1,
        ];
    }
}
