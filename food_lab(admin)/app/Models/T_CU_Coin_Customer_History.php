<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class T_CU_Coin_Customer_History extends Model
{
    public $table = 't_cu_coin_customer_history';
    use HasFactory;

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set coin history.
    * Parameters : customer_id and add coin amount
    * Return : no
    */
    public function setCoinHistory($customer_id,int $add_coin,$note)
    {
        Log::channel('adminlog')->info("T_CU_Coin_Customer_History Model", [
            'Start setCoinHistory'
        ]);

        $current_coin = T_CU_Coin_Customer_History::where('customer_id', $customer_id)
        ->where('del_flg',0)
        ->orderBy('updated_at','DESC')
        ->first();


        $t_cu_coin_customer_history = new T_CU_Coin_Customer_History();
        $t_cu_coin_customer_history->customer_id = $customer_id;
        $t_cu_coin_customer_history->add_coin = $add_coin;
        $t_cu_coin_customer_history->balance_coin = ($current_coin==null ? 0 : $current_coin->balance_coin)+ $add_coin;
        $t_cu_coin_customer_history->last_control_by = session('adminId');
        $t_cu_coin_customer_history->note= $note;
        $t_cu_coin_customer_history->by_action = 0;
        $t_cu_coin_customer_history->save();

        Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
            'End setCoinHistory'
        ]);
    }

}
