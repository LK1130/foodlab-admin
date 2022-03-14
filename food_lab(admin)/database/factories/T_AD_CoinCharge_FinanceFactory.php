<?php

namespace Database\Factories;

use App\Models\T_AD_CoinCharge_Finance;
use Illuminate\Database\Eloquent\Factories\Factory;

class T_AD_CoinCharge_FinanceFactory extends Factory
{
    protected $model = T_AD_CoinCharge_Finance::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'charge_id' =>1,
            'payment_type' => $this->faker->numberBetween(1, 4),
            'amount' =>$this->faker->numerify('####'),
            'del_flg' => 0,
            'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now'),
         ];
    }
}
