<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_CU_Coin_Customer extends Model
{
    public $table = 't_cu_coin_customer';
    use HasFactory;

    /*
    * Create : linn(2022/01/16)
    * Update :
    * This function is use to set coin.
    * Parameters : customer_id and add coin amount
    * Return : no
    */
    public function setCoin($customer_id, $add_coin)
    {
        Log::channel('adminlog')->info("T_CU_Coin_Customer Model", [
            'Start setCoin'
        ]);

        $current_coin = T_CU_Coin_Customer::where('customer_id', $customer_id)
            ->where('del_flg', 0)
            ->first();

        // check is num insert the customer coin amount
        if ($current_coin == null) {
            $t_cu_coin_customer = new T_CU_Coin_Customer();
            $t_cu_coin_customer->customer_id = $customer_id;
            $t_cu_coin_customer->remain_coin = $add_coin;
            $t_cu_coin_customer->save();
        } else { // update the customer coin amount
            T_CU_Coin_Customer::where('customer_id', $customer_id)
                ->update([
                    'remain_coin' =>  $current_coin->remain_coin + $add_coin
                ]);
        }

        Log::channel('adminlog')->info("T_CU_Coin_Customer Model", [
            'End setCoin'
        ]);
    }


    /* Create:Min Khant(22/2/2022)
      * Update:
      * This is function is to calculate customer coin amount after buy product
      * Parameter : customer id , total coin
      * Return no
      */
    public function calCustomerCoin($id, $remain_coin, $sub_coin)
    {
        Log::channel('customerlog')->info('DeliveryInfoController', [
            'start customerCoin'
        ]);
        $calCoin = $remain_coin - $sub_coin;

        DB::transaction(function () use ($id, $calCoin, $sub_coin) {
            T_CU_Coin_Customer::where('customer_id', $id)
                ->update([
                    'remain_coin' => $calCoin
                ]);

            $tCuCoinHistory = new T_CU_Coin_Customer_History();
            $tCuCoinHistory->customer_id = $id;
            $tCuCoinHistory->add_coin = -$sub_coin;
            $tCuCoinHistory->balance_coin = $calCoin;
            $tCuCoinHistory->note = 'Buy Product';
            $tCuCoinHistory->by_action = '1';
            $tCuCoinHistory->save();
        });

        Log::channel('customerlog')->info('DeliveryInfoController', [
            'end customerCoin'
        ]);
    }
}
