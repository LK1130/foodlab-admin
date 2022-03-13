<?php

namespace Database\Seeders;

use App\Models\T_AD_CoinCharge;
use Illuminate\Database\Seeder;

class CoinListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        T_AD_CoinCharge::factory(10000)->create();
    }
}
