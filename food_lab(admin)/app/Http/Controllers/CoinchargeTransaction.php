<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\T_AD_CoinCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CoinchargeTransaction extends Controller
{
    /*
    * Create:zarni(2022/01/12) 
    * Update: 
    * This is function is to show admin Coin charge List.
    * Return is view (coinchargeList.blade.php)
    */
    public function coinchargeList()
    {

        Log::channel('adminlog')->info("CoinchargeTransaction Controller", [
            'Start coinchargeList'
        ]);

        $coin = new T_AD_CoinCharge();
        $coincharge = $coin->coinchargeLists();

        Log::channel('adminlog')->info("CoinchargeTransaction Controller", [
            'End coinchargeList'
        ]);
        return view('admin.transactions.coinchargeList', ['t_ad_coincharge' => $coincharge]);
    }
}
