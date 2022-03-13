<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_AD_CoinRate;
use App\Models\M_Product;
use App\Models\T_AD_CoinCharge;
use App\Models\T_AD_Contact;
use App\Models\T_AD_Order;
use App\Models\T_AD_OrderDetail;
use App\Models\T_AD_Report;
use App\Models\T_AD_Suggest;
use App\Models\T_CU_Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /*
    * Create:Zarni(2022/01/12) 
    * Update: 
    * This is function is to show admin dashboard Listing
    * Return is view (dashboard.blade.php)
    */
    public function dashboardList()
    {

        Log::channel('adminlog')->info("DashboardController", [
            'Start dashboardList'
        ]);

        $detail = new T_AD_Order();
        $orderdetail = $detail->DashboardMinitrans();

        $customer = new T_CU_Customer();
        $customerlist = $customer->DashboardMinicus();

        $coin = new T_AD_CoinCharge();
        $coincharge  = $coin->Dashboardminicoin();

        $tcount = new T_AD_Order();
        $transcount1 = $tcount->Dashboardtranscount();

        $cuscount = new T_CU_Customer();
        $customercount = number_format($cuscount->Dashboardcuscount());

        $rateofcoin = new M_AD_CoinRate();
        $coinrate = $rateofcoin->DashboardCoinrate();

        $today = new T_AD_Order();
        $todayorder = $today->Todayordercount();

        $product = new M_Product();
        $dashproduct = $product->DashboardproductList();

        $cussuggest = new T_AD_Suggest();
        $sugcount = $cussuggest->suggestcount();

        $cuscontact = new T_AD_Contact();
        $conCount = $cuscontact->contactCount();

        $cusreport = new T_AD_Report();
        $rpcount = $cusreport->reportCount();

        $top = new T_AD_OrderDetail();
        $top3 = $top->topthree();

        Log::channel('adminlog')->info("DashboardController", [
            'End dashboardList'
        ]);

        return view('admin.dashboard', ['t_cu_customer' => $customerlist, 'orderdetail' => $orderdetail, 'coincharge' => $coincharge, 'tcount' => $transcount1, 'cuscount' => $customercount, 'coinrate' => $coinrate, 'todaycount' => $todayorder, 'product' => $dashproduct, 'sugcount' => $sugcount, 'concount' => $conCount, 'rpcount' => $rpcount, 'top' => $top3]);
    }
}
