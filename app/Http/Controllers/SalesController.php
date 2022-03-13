<?php

namespace App\Http\Controllers;

use App\Http\Requests\RangeChart;
use App\Http\Controllers\Controller;
use App\Models\CoinChargeFinance;
use App\Models\OrderTransactionCheck;
use App\Models\T_AD_CoinCharge_Finance;
use App\Models\T_AD_Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesController extends Controller
{
    /* admin
     * Create : Cherry(13/1/2022)
     * Update :Cherry(14/1/2022)
     * Explain of function : For getting total order amount  of daily from t_ad_order and 
     *                         total money amount of daily from  t_ad_coincharge_finance
     * Prarmeter : no
     * return : view 'admin.salesChart.dailySale'; 
     * */
    public function dailyChart()
    {
        Log::channel('adminlog')->info("SalesController", [
            'Start dailyChart'
        ]);
        // Get Coin Daily Data From T_AD_CoinCharge_Finance Model //
        $T_AD_CoinCharge_Finance = new T_AD_CoinCharge_Finance();
        $coinList = $T_AD_CoinCharge_Finance->coinDaily();

        // Senting daily coin data to dailyChart.js
        $coinDaily = [];
        foreach ($coinList as $key => $value) {
            array_push($coinDaily, $value->day);
        };
        $coinArray = [];
        foreach ($coinList as $key => $value) {
            array_push($coinArray, $value->totalAmount);
        };

        // Get Order Daily Data From T_AD_Order Model //
        $T_AD_Order = new T_AD_Order();
        $orderList =  $T_AD_Order->orderDaily();

        // Senting daily order data to dailyChart.js
        $orderDaily = [];
        foreach ($orderList as $key => $value) {
            array_push($orderDaily, $value->day);
        };
        $orderArray = [];
        foreach ($orderList as $key => $value) {
            array_push($orderArray, $value->totalorder);
        };

        $dailyCointable = $T_AD_CoinCharge_Finance->dailyCointable();
        $dailyOrdertable = $T_AD_Order->orderDailyList();

        // return $dailyCointable;

        Log::channel('adminlog')->info("SalesController", [
            'End dailyChart'
        ]);

        return  view('admin.salesChart.dailySale', ['dailycoinlist' => $dailyCointable, 'dailyorderlist' => $dailyOrdertable, 'orderArray' => $orderArray, 'coinArray' => $coinArray, 'orderDaily' => $orderDaily, 'coinDaily' => $coinDaily]);
    }
    /*admin
     * Create : Cherry(11/1/2022)
     * Update :Cherry(14/1/2022)
     * Explain of function : For getting total order amount  of monthly from t_ad_order and 
     *                         total money amount of monthly from  t_ad_coincharge_finance
     * Prarmeter : no
     * return : view 'admin.salesChart.monthlySale' ; 
     * */
    public function monthlyChart()
    {
        Log::channel('adminlog')->info("SalesController", [
            'Start monthlyChart'
        ]);
        // Get Coin Monthly Data From T_AD_CoinCharge_Finance Model //
        $T_AD_CoinCharge_Finance = new T_AD_CoinCharge_Finance();
        $coinList = $T_AD_CoinCharge_Finance->coinMonthly();

        // Senting monthly coin data to monthlyChart.js
        $coinArray = [];
        foreach ($coinList as $key => $value) {
            array_push($coinArray, $value->totalAmount);
        };
        $coinMonthly = [];
        foreach ($coinList as $key => $value) {
            // $monthNumber= $value->month;
            // array_push($orderMonthly, date("F", mktime($monthNumber)));
            array_push($coinMonthly, $value->month);
        };

        // Get Order Monthly Data From T_AD_Order Model //
        $T_AD_Order = new T_AD_Order();
        $orderList =  $T_AD_Order->orderMonthly();
        // Senting monthly order data to monthlyChart.js
        $orderMonthly = [];
        foreach ($orderList as $key => $value) {
            array_push($orderMonthly, $value->month);
        };

        $orderArray = [];
        foreach ($orderList as $key => $value) {
            array_push($orderArray, $value->totalorder);
        };

        $orderListtable = $T_AD_Order->ordermonthlyList();
        $coinListtable = $T_AD_CoinCharge_Finance->coinmonthlyTable();


        Log::channel('adminlog')->info("SalesController", [
            'End monthlyChart'
        ]);

        return  view('admin.salesChart.monthlySale', ['coinListtable' => $coinListtable, 'orderList' => $orderListtable, 'orderArray' => $orderArray, 'coinArray' => $coinArray, 'orderMonthly' => $orderMonthly, 'coinMonthly' => $coinMonthly]);
    }
    /*admin
     * Create : Cherry(12/1/2022)
     * Update :Cherry(14/1/2022)
     * Explain of function : For getting total order amount  of yearly from t_ad_order and 
     *                         total money amount of yearly from  t_ad_coincharge_finance
     * Prarmeter : no
     * return : view 'admin.salesChart.yearlySale' ; 
     * */
    public function yearlyChart()
    {
        Log::channel('adminlog')->info("SalesController", [
            'Start yearlyChart'
        ]);
        // Get Coin Yeatly Data From T_AD_CoinCharge_Finance Model //
        $T_AD_CoinCharge_Finance = new T_AD_CoinCharge_Finance();
        $coinList = $T_AD_CoinCharge_Finance->coinMonthly();
        // Senting yearlyy coin data to yearlyChart.js
        $coinArray = [];
        foreach ($coinList as $key => $value) {
            array_push($coinArray, $value->totalAmount);
        };
        $coinYearly = [];
        foreach ($coinList as $key => $value) {
            array_push($coinYearly, $value->year);
        };

        // Get Order Yearly Data From T_AD_Order Model //
        $T_AD_Order = new T_AD_Order();
        $orderList =  $T_AD_Order->orderMonthly();
        // Senting yearly order data to yearlyChart.js
        $orderArray = [];
        foreach ($orderList as $key => $value) {
            array_push($orderArray, $value->totalorder);
        };
        $orderYearly = [];
        foreach ($orderList as $key => $value) {
            array_push($orderYearly, $value->year);
        };

        $orderlistTable = $T_AD_Order->orderyearlyList();
        $coinlistTable = $T_AD_CoinCharge_Finance->coinyearlyTable();



        Log::channel('adminlog')->info("SalesController", [
            'End yearlyChart'
        ]);

        return  view('admin.salesChart.yearlySale', ['coinlistTable' => $coinlistTable, 'orderlistTable' => $orderlistTable, 'orderArray' => $orderArray, 'coinArray' => $coinArray, 'coinYearly' => $coinYearly, 'orderYearly' => $orderYearly]);
    }
    /*admin
     * Create : Cherry(14/1/2022)
     * Update :
     * Explain of function : For showing data charts between start date and end date
     * Prarmeter : no
     * return : 'admin.salesChart.rangeSale'
     * */
    public function rangeChart(Request $request)
    {
        Log::channel('adminlog')->info("SalesController", [
            'Start rangeChart'
        ]);
        $datas = [];
        $validated = $request['data'];
        $fromDate = $validated['fromDate'];
        $toDate = $validated['toDate'];

        // Get Searching Coin Data From T_AD_CoinCharge_Finance Model //
        $T_AD_CoinCharge_Finance = new T_AD_CoinCharge_Finance();
        $coinList = $T_AD_CoinCharge_Finance->coinRange($validated);
        // Senting coin data to rangeChart.js
        $coinDaily = [];
        foreach ($coinList as $key => $value) {
            array_push($coinDaily, $value->date);
        };
        array_push($datas, $coinDaily);

        $coinArray = [];
        foreach ($coinList as $key => $value) {
            array_push($coinArray, $value->totalAmount);
        };
        array_push($datas, $coinArray);
        // Get searching Order Data From T_AD_Order Model //
        $T_AD_Order = new T_AD_Order();
        $orderList =  $T_AD_Order->orderRange($validated);
        // Senting order data to rangeChart.js
        $orderDaily = [];
        foreach ($orderList as $key => $value) {
            array_push($orderDaily, $value->date);
        };
        array_push($datas, $orderDaily);

        $orderArray = [];
        foreach ($orderList as $key => $value) {
            array_push($orderArray, $value->totalorder);
        };
        array_push($datas, $orderArray);

        Log::channel('adminlog')->info("SalesController", [
            'End rangeChart'
        ]);

        return $datas;
        // return  view('admin.salesChart.rangeSale', ['datas' => $datas, 'orderArray' => $orderArray, 'orderDaily' => $orderDaily, 'coinArray' => $coinArray, 'coinDaily' => $coinDaily]);
    }

    // admin 
    public function rangeSale(Request $req)
    {
        return $req;
    }
}
