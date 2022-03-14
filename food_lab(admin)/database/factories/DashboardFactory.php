<?php

namespace Database\Factories;

use App\Models\DashBoard;
use App\Models\T_CU_Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DashboardFactory extends Factory
{
    protected $model = T_CU_Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customerID'=>$this->faker->numerify('U#####'),
            'nickname'=>$this->faker->name(),
            'bio'=>$this->faker->name(),
            'phone'=>$this->faker->numerify('########'),
            'address3'=>$this->faker->address()
        ];
    }
}
