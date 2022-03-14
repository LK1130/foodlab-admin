<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderTransactionCheck;
use App\Models\T_AD_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderTransactionController extends Controller
{
            /*
    * Create:Zarni(2022/01/12) 
    * Update: 
    * This is function is to get data form database for ordertransaction
    * Return is view (customerInfo.blade.php)
    */
    public function orderTransaction(){

        Log::channel('adminlog')->info("OrderTransactionController", [
            'Start orderTransaction'
        ]);

        $detail = new T_AD_Order();
        $orderdetail = $detail->OrderTransactions();

        Log::channel('adminlog')->info("OrderTransactionController", [
            'End orderTransaction'
        ]);

        return view('admin.transactions.orderTransaction',['t_ad_order'=>$orderdetail]);
    }
}
