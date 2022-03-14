<?php

namespace App\Http\Controllers;

use App\Common\Variable;
use App\Http\Controllers\Controller;
use App\Models\M_AD_CoinCharge_Message;
use App\Models\M_AD_CoinRate;
use App\Models\M_Payment;
use App\Models\M_Product;
use App\Models\T_AD_CoinCharge;
use App\Models\T_AD_CoinCharge_Decision_History;
use App\Models\T_AD_CoinCharge_Finance;
use App\Models\T_CU_Coin_Customer;
use App\Models\T_CU_Coin_Customer_History;
use App\Models\T_CU_Customer;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CoinController extends Controller
{

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to show coin listing.
    * Parameters : no
    * Return : view('admin.coin.list')
    */
    public function list()
    {
        $commonVar = new Variable();
        Log::channel('adminlog')->info("CoinController", [
            'Start list'
        ]);
        $t_ad_coincharge = new T_AD_CoinCharge();
        // Request
        $request = $t_ad_coincharge->listing($commonVar->REQUEST, 'request');
        // Approve
        $approve = $t_ad_coincharge->listing($commonVar->APPROVE, 'approve');
        // Waiting
        $waiting = $t_ad_coincharge->listing($commonVar->WAITING, 'waiting');
        // Reject
        $reject = $t_ad_coincharge->listing($commonVar->REJECT, 'reject');

        Log::channel('adminlog')->info("CoinController", [
            'End list'
        ]);
        // Return to view
        return view('admin.coin.list', ['request' => $request, 'approve' => $approve, 'waiting' => $waiting, 'reject' => $reject]);
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to show coin change history.
    * Parameters : no
    * Return : view('admin.coin.rateHistory')
    */
    public function rateHistory()
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start rateHistory'
        ]);
        $commonVar = new Variable();
        $admin = new M_AD_CoinRate();
        $admins = $admin->coinHistory();

        Log::channel('adminlog')->info("CoinController", [
            'End rateHistory'
        ]);

        return view('admin.coin.rateHistory', ['admins' => $admins]);
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to show coin change history.
    * Parameters : no
    * Return : view('admin.coin.rateChange')
    */
    public function rateChange()
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start rateChange'
        ]);

        Log::channel('adminlog')->info("CoinController", [
            'End rateChange'
        ]);

        return view('admin.coin.rateChange');
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : Aung Min Khant (2022/22/2)
    * This function is use to show coin change history. and change existing all product coin rate
    * Parameters : no
    * Return : view('admin.coin.rateHistory')
    */
    public function rateStore(Request $request)
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start rateStore'
        ]);

        $request->validate([
            'kyat' => 'required|min:0|max:100000|numeric',
            'note' => 'required|min:10|max:255'
        ]);
        $admin = new M_AD_CoinRate();
        $admin->coinRateChange($request);

        $rates = $admin->getRate();
        $products = new M_Product();
        $products->changeAmount($rates->rate);

        Log::channel('adminlog')->info("CoinController", [
            'End rateStore'
        ]);

        return redirect('rateHistory');
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to show coin change history.
    * Parameters : charge id
    * Return : view('admin.coin.rateHistory')
    */
    public function decision($id)
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start decision'
        ]);
        // Get Coin Detail Info
        $t_ad_coincharge = new T_AD_CoinCharge();
        $chargeDetail = $t_ad_coincharge->chargeDetail($id);

        if ($chargeDetail == null) abort(404);

        // Get Payment List for Payment Select Box
        $m_payment = new M_Payment();
        $paymentList = $m_payment->getPayment();

        $path = $t_ad_coincharge->getChargePhoto($id);
        //if ($path == null) abort(500);

        $m_ad_coinrate = new M_AD_CoinRate();
        $rate = $m_ad_coinrate->getRate();

        //Get History
        $t_ad_coincharge_decision_history = new T_AD_CoinCharge_Decision_History();
        $history = $t_ad_coincharge_decision_history->findHistoryById($id);

        Log::channel('adminlog')->info("CoinController", [
            'End decision'
        ]);

        return view('admin.coin.decision', [
            'Cdetail' => $chargeDetail,
            'paymentlist' => $paymentList,
            'path' => $path,
            'rate' => $rate->rate,
            'history' => $history
        ]);
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to show coin change history.
    * Parameters : charge id
    * Return : view('admin.coin.rateHistory')
    */
    public function reDecision($id)
    {
        Log::channel('adminlog')->info(
            "CoinController",
            [
                'Start reDecision'
            ]
        );
        // Get Coin Detail Info
        $t_ad_coincharge = new T_AD_CoinCharge();
        $chargeDetail = $t_ad_coincharge->chargeDetail($id);

        if ($chargeDetail == null) abort(404);

        // Get Payment List for Payment Select Box
        $m_payment = new M_Payment();
        $paymentList = $m_payment->getPayment();

        $path = $t_ad_coincharge->getChargePhoto($id);
        //if ($path == null) abort(500);

        $m_ad_coinrate = new M_AD_CoinRate();
        $rate = $m_ad_coinrate->getRate();

        //Get History
        $t_ad_coincharge_decision_history = new T_AD_CoinCharge_Decision_History();
        $history = $t_ad_coincharge_decision_history->findHistoryById($id);

        Log::channel('adminlog')->info("CoinController", [
            'End reDecision'
        ]);

        return view('admin.coin.redecision', [
            'Cdetail' => $chargeDetail,
            'paymentlist' => $paymentList,
            'path' => $path,
            'rate' => $rate->rate,
            'history' => $history
        ]);
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to show coin change history.
    * Parameters : charge id
    * Return : view('admin.coin.rateHistory')
    */
    public function detailCharge($id)
    {
        Log::channel('adminlog')->info(
            "CoinController",
            [
                'Start detailCharge'
            ]
        );
        // Get Coin Detail Info
        $t_ad_coincharge = new T_AD_CoinCharge();
        $chargeDetail = $t_ad_coincharge->chargeDetail($id);

        if ($chargeDetail == null) abort(404);

        // Get Payment List for Payment Select Box
        $m_payment = new M_Payment();
        $paymentList = $m_payment->getPayment();

        $path = $t_ad_coincharge->getChargePhoto($id);
        //if ($path == null) abort(500);

        $m_ad_coinrate = new M_AD_CoinRate();
        $rate = $m_ad_coinrate->getRate();

        //Get History
        $t_ad_coincharge_decision_history = new T_AD_CoinCharge_Decision_History();
        $history = $t_ad_coincharge_decision_history->findHistoryById($id);

        Log::channel('adminlog')->info("CoinController", [
            'End detailCharge'
        ]);

        return view('admin.coin.detail', [
            'Cdetail' => $chargeDetail,
            'paymentlist' => $paymentList,
            'path' => $path,
            'rate' => $rate->rate,
            'history' => $history
        ]);
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to Approve Waiting Reject.
    * Parameters : no
    * Return : view('admin.coin.rateHistory')
    */
    public function makeDecision(Request $request)
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start makeDecision'
        ]);

        $request->validate([
            'payment' => 'required',
            'amount' => 'required',
            'note' => 'required',
            'decision' => 'required',
            'chargeId' => 'required',
            'coin' => 'required'
        ]);

        DB::transaction(
            function () use ($request) {
                $common = new Variable;

                $t_ad_coincharge = new T_AD_CoinCharge();
                $charge = $t_ad_coincharge->findChargeById($request->chargeId);
                if ($charge == null) abort(404);

                //Double Check
                if ($request->decision == $common->APPROVE) {
                    $m_ad_coinrate = new M_AD_CoinRate();
                    $rate = $m_ad_coinrate->getRate()->rate;
                    if ((int)$request->amount / (int)$rate != (int)$charge->request_coin)
                        return back()->withErrors(['message' => 'Transcation Not Correct.Try Again']);
                }
                // Record History
                $t_ad_coincharge_decision_history = new T_AD_CoinCharge_Decision_History();
                $t_ad_coincharge_decision_history->setDecisionHistory(
                    $request->chargeId,
                    $charge->decision_status,
                    $request->decision,
                    $request->note
                );

                // Check decision 
                if (
                    $request->decision != $common->APPROVE &&
                    $request->decision != $common->WAITING &&
                    $request->decision != $common->REJECT
                ) abort(404);

                // Set Status
                $t_ad_coincharge = new T_AD_CoinCharge();
                $t_ad_coincharge->setChargeDecision($request->chargeId, $request->decision);

                // Add only approve
                if ($request->decision == $common->APPROVE) {
                    $t_ad_Coincharage_finance = new T_AD_CoinCharge_Finance();
                    $t_ad_Coincharage_finance->setChargeFinance(
                        $request->chargeId,
                        $request->amount,
                        $request->payment
                    );

                    // Set Coin History
                    $t_cu_coin_customer_history = new T_CU_Coin_Customer_History();
                    $t_cu_coin_customer_history->setCoinHistory($charge->customer_id, $charge->request_coin, $request->note);

                    // Set Coin Table
                    $t_cu_coin_customer = new T_CU_Coin_Customer();
                    $t_cu_coin_customer->setCoin($charge->customer_id, $charge->request_coin);
                }

                //Set Message to m_ad_coincharge_message
                $m_ad_coincharge_message = new M_AD_CoinCharge_Message();
                switch ($request->decision) {
                    case $common->APPROVE:
                        $m_ad_coincharge_message->addMessage($common->APP, $common->APP_MESSAGE_DET, $request->chargeId);
                        break;
                    case $common->WAITING:
                        $m_ad_coincharge_message->addMessage($common->WAIT, $common->WAIT_MESSAGE_DET, $request->chargeId);
                        break;
                    case $common->REJECT:
                        $m_ad_coincharge_message->addMessage($common->REJ, $common->REJ_MESSAGE_DET, $request->chargeId);
                        break;
                }
            }
        );

        Log::channel('adminlog')->info("CoinController", [
            'End makeDecision'
        ]);

        return redirect('/coinListing');
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to Approve Waiting Reject.
    * Parameters : no
    * Return : view('admin.coin.rateHistory')
    */
    public function makeReDecision(Request $request)
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start makeDecision'
        ]);

        $request->validate([
            'note' => 'required',
            'decision' => 'required',
            'chargeId' => 'required'
        ]);

        DB::transaction(
            function () use ($request) {
                $common = new Variable;

                $t_ad_coincharge = new T_AD_CoinCharge();
                $charge = $t_ad_coincharge->findChargeById($request->chargeId);

                // Record History
                $t_ad_coincharge_decision_history = new T_AD_CoinCharge_Decision_History();
                $t_ad_coincharge_decision_history->setDecisionHistory(
                    $request->chargeId,
                    $charge->decision_status,
                    $request->decision,
                    $request->note
                );

                // Set Status
                $t_ad_coincharge = new T_AD_CoinCharge();
                $t_ad_coincharge->setChargeDecision($request->chargeId, $request->decision, 1);

                // Reset if waiting
                if ($request->decision == $common->WAITING) {
                    $t_ad_Coincharage_finance = new T_AD_CoinCharge_Finance();
                    // $subAmount =  $t_ad_Coincharage_finance->getFinance($request->chargeId);

                    // Set Coin History
                    $t_cu_coin_customer_history = new T_CU_Coin_Customer_History();
                    $t_cu_coin_customer_history->setCoinHistory($charge->customer_id, - ($charge->request_coin), $request->note);

                    // Set Coin Table
                    $t_cu_coin_customer = new T_CU_Coin_Customer();
                    $t_cu_coin_customer->setCoin($charge->customer_id, - ($charge->request_coin));

                    // reset Finance Table
                    $t_ad_Coincharage_finance->reSetFinance($request->chargeId);
                }

                //Set Message to m_ad_coincharge_message
                $m_ad_coincharge_message = new M_AD_CoinCharge_Message();
                switch ($request->decision) {
                    case $common->APPROVE:
                        $m_ad_coincharge_message->addMessage($common->APP, $common->APP_MESSAGE_DET, $request->chargeId);
                        break;
                    case $common->WAITING:
                        $m_ad_coincharge_message->addMessage($common->WAIT, $common->WAIT_MESSAGE_DET, $request->chargeId);
                        break;
                    case $common->REJECT:
                        $m_ad_coincharge_message->addMessage($common->REJ, $common->REJ_MESSAGE_DET, $request->chargeId);
                        break;
                }
            }
        );

        Log::channel('adminlog')->info("CoinController", [
            'End makeDecision'
        ]);

        return redirect('/coinListing');
    }


    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to show coin change history.
    * Parameters : charge id
    * Return : view('admin.coin.rateHistory')
    */
    public function addCoin()
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start addCoin'
        ]);
        Log::channel('adminlog')->info("CoinController", [
            'End addCoin'
        ]);

        return View('admin.coin.add');
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to search Customer By Customer ID.
    * Parameters : charge id
    * Return : view('admin.coin.rateHistory')
    */
    public function searchCustomer(Request $request)
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start searchCustomer'
        ]);
        $t_cu_customer = new T_CU_Customer();
        $customer = $t_cu_customer->searchByID($request->id);

        if ($customer == null) {
            Log::channel('adminlog')->info("CoinController", [
                'End searchCustomer'
            ]);

            return response()->json([
                'error' => 1,
            ]);
        }
        Log::channel('adminlog')->info("CoinController", [
            'End searchCustomer'
        ]);
        return response()->json([
            'nickname' => $customer->nickname,
            'cid' => $customer->customerID,
            'coin' => number_format($customer->remain_coin),
            'phone' => $customer->phone,
        ]);
    }

    /*
    * Create : linn(2022/01/17) 
    * Update : 
    * This function is use to add coin to customer.
    * Parameters : Request 
    * Return : view('admin.coin.addCoin')
    */
    public function addCoinCustomer(Request $request)
    {
        Log::channel('adminlog')->info("CoinController", [
            'Start addCoinCustomer'
        ]);


        $request->validate([
            'note' => 'required',
            'amount' => 'required',
            'customerid' => 'required'
        ]);

        DB::transaction(
            function () use ($request) {
                $t_cu_customer = new T_CU_Customer();
                $customer = $t_cu_customer->searchByCustomerID($request->customerid);

                if ($customer == null) abort(500);

                // Set Coin History
                $t_cu_coin_customer_history = new T_CU_Coin_Customer_History();
                $t_cu_coin_customer_history->setCoinHistory($customer->id, $request->amount, $request->note);

                // Set Coin Table
                $t_cu_coin_customer = new T_CU_Coin_Customer();
                $t_cu_coin_customer->setCoin($customer->id, $request->amount);
            }
        );


        Log::channel('adminlog')->info("CoinController", [
            'End addCoinCustomer'
        ]);

        return redirect('addCoin');
    }

    /*
    * Create:zayar(2022/01/12) 
    * Update: 
    * This is function is use to show coin rate changed history.(admin)
    */
    public function index()
    {
        $admin = new M_AD_CoinRate();
        $admins = $admin->coinHistory();
        return view('admin.setting.coinRate.coinRate', ['admins' => $admins]);
    }

    /*
    * Create:zayar(2022/01/12) 
    * Update: 
    * This is function is used to show the coin rate change view. (admin)
    */
    public function create()
    {
        return view('admin.setting.coinRate.coinRateChange');
    }

    /*
    * Create:zayar(2022/01/12) 
    * Update: 
    * This is function is used to save coin rate change history in database.(admin)
    * $request is user input values.
    */
    public function store(Request $request)
    {
        $request->validate([
            'kyat' => 'required|min:0|max:100000|numeric',
            'note' => 'required|min:10|max:255'
        ]);
        $admin = new M_AD_CoinRate();
        $admin->coinRateChange($request);
        return redirect('coinrate');
    }
}
