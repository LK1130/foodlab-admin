<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_AD_CoinCharge_Message extends Model
{
    public $table = 'm_ad_coincharge_message';
    use HasFactory;

    /*
    * Create:Linn Ko(2022/02/17) 
    * Update: 
    * This is method is used to add coin decision message to user notification.

    */
    public function addMessage($title, $detail, $chargeID)
    {
        Log::channel('adminlog')->info("M_AD_CoinCharge_Message Model", [
            'Start addMessage'
        ]);

        $result = new M_AD_CoinCharge_Message();
        $result->title = $title;
        $result->detail = $detail;
        $result->charge_id = $chargeID;
        $result->seen = 0;
        $result->save();

        Log::channel('adminlog')->info("M_AD_CoinCharge_Message Model", [
            'End addMessage'
        ]);

        return $result;
    }
}
