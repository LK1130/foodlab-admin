<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_CoinCharge extends Model
{
  public  $table = 't_ad_coincharge';
  use HasFactory;

  /* Create:Zarni(2022/01/16) 
    * Update: 
    * This is function is to show the data of admin CoinChargeList
    * Return 
    */
  public function coinchargeLists()
  {

    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start coinchargeLists'
    ]);

    $coinchargelist = T_AD_CoinCharge::select('*', DB::raw('t_ad_coincharge.id AS chargeid'))
      ->join('m_ad_login', 'm_ad_login.id', '=', 't_ad_coincharge.decision_by')
      ->join('m_decision_status', 'm_decision_status.id', '=', 't_ad_coincharge.decision_status')
      ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
      ->where('t_ad_coincharge.del_flg', 0)
      ->orderby('t_ad_coincharge.request_datetime', 'DESC')
      ->paginate(10);

    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End coinchargeLists'
    ]);

    return $coinchargelist;
  }
  /* Create:Zarni(2022/01/16) 
    * Update: 
    * This is function is to show the data of admin DashboardminiCoinchargeList
    * Return 
    */
  public function Dashboardminicoin()
  {

    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start Dashboardminicoin'
    ]);

    $dashboardcoin = T_AD_CoinCharge::join('m_ad_login', 'm_ad_login.id', '=', 't_ad_coincharge.decision_by')
      ->join('m_decision_status', 'm_decision_status.id', '=', 't_ad_coincharge.decision_status')
      ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
      ->where('t_ad_coincharge.del_flg', 0)
      ->orderby('t_ad_coincharge.request_datetime', 'DESC')
      ->limit(5)
      ->get();

    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End Dashboardminicoin'
    ]);

    return $dashboardcoin;
  }
  /* Create:Zarni(2022/01/16) 
    * Update: 
    * This is function is to show the coincharge Data for Customerinfo Detail
    * Return 
    */
  public function UsercoinchargeList($id)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start UsercoinchargeList'
    ]);

    $usercoin = T_AD_CoinCharge::select('*', DB::raw('t_ad_coincharge.id AS chargeid'))
      ->join('m_ad_login', 'm_ad_login.id', '=', 't_ad_coincharge.decision_by')
      ->join('m_decision_status', 'm_decision_status.id', '=', 't_ad_coincharge.decision_status')
      ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
      ->where('t_ad_coincharge.del_flg', 0)
      ->where('t_ad_coincharge.customer_id', '=', $id)
      ->paginate(10, ['*'], 'customerCoin');

    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End UsercoinchargeList'
    ]);
    return $usercoin;
  }
  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to show coin listing.
    * Parameters : no
    * Return : all data
    */
  public function listing($status, $category)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start listing'
    ]);

    if ($status == 1)
      $result =  T_AD_CoinCharge::select(
        '*',
        DB::raw('t_ad_coincharge.id AS chargeid'),
        DB::raw('t_ad_coincharge.updated_at AS updatetime')
      )
        ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
        ->leftjoin('m_ad_login', 'm_ad_login.id', '=', 't_ad_coincharge.decision_by')
        ->where('decision_status', $status)
        ->where('t_ad_coincharge.del_flg', 0)
        ->orderby('request_datetime', 'desc')
        ->paginate(10, ['*'], $category);

    if ($status == 2 || $status == 3 || $status == 4)
      $result =  T_AD_CoinCharge::select(
        '*',
        DB::raw('t_ad_coincharge.id AS chargeid'),
        DB::raw('t_ad_coincharge.updated_at AS updatetime')
      )
        ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
        ->join('m_ad_login', 'm_ad_login.id', '=', 't_ad_coincharge.decision_by')
        ->where('decision_status', $status)
        ->where('t_ad_coincharge.del_flg', 0)
        ->orderby('updatetime', 'desc')
        ->paginate(10, ['*'], $category);
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End listing'
    ]);

    return $result;
  }

  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to get charge detail.
    * Parameters : no
    * Return : charge data
    */
  public function chargeDetail($chargeid)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start charageDetail'
    ]);

    $result =  T_AD_CoinCharge::select(
      '*',
      DB::raw('t_cu_customer.id AS customerid'),
      DB::raw('m_decision_status.id AS statusid'),
      DB::raw('t_ad_coincharge.id AS chargeid')
    )

      ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
      ->join('m_cu_customer_login', 'm_cu_customer_login.customer_id', '=', 't_cu_customer.id')
      ->join('m_decision_status', 'm_decision_status.id', '=', 't_ad_coincharge.decision_status')
      ->where('t_ad_coincharge.del_flg', 0)
      ->where('t_ad_coincharge.id', $chargeid)
      ->first();


    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End charageDetail'
    ]);

    return $result;
  }

  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to get photo path.
    * Parameters : no
    * Return : photo path
    */
  public function getChargePhoto($chargeid)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start getChargePhoto'
    ]);

    $evd_id = T_AD_CoinCharge::find($chargeid);

    if ($evd_id == null) abort(500);

    $result =  T_AD_Evd::select('path')
      ->where('id', $evd_id->request_evd_ID)
      ->where('del_flg', 0)
      ->first();

    if ($result == null) abort(500);

    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End getChargePhoto'
    ]);

    return $result;
  }

  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set desicion.
    * Parameters : no
    * Return : photo path
    */
  public function setChargeDecision($chargeid, $decision, $isRedecision = 0)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start setChargeDecision'
    ]);

    T_AD_CoinCharge::where('del_flg', 0)
      ->where('id', $chargeid)
      ->update([
        'decision_status' => $decision,
        'decision_by' => session('adminId'),
        're_decision' => $isRedecision
      ]);


    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End setChargeDecision'
    ]);
  }

  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to find charge Id.
    * Parameters : no
    * Return : photo path
    */
  public function findChargeById($chargeid)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start findChargeById'
    ]);

    $result = T_AD_CoinCharge::where('del_flg', 0)
      ->where('id', $chargeid)
      ->first();


    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End findChargeById'
    ]);

    return $result;
  }


  public function evdConnect()
  {
    return $this->belongsTo("App\Models\T_AD_Evd");
  }
}
