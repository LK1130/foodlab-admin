<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\FuncCall;
use SebastianBergmann\Environment\Console;
use App\Common\Method;

class T_CU_Customer extends Model
{
  public $table = 't_cu_customer';
  use HasFactory;

  /*
      * Create : Zar Ni(15/1/2022)
      * Update :
      * Explain of function : To get data for DashboardCustomerMiniList
      * Prarameter : no
      * return :
    */
  public function DashboardMinicus()
  {

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start DashboardMinicus'
    ]);
    $dashboardcus = T_CU_Customer::limit(5)
      ->where('del_flg', 0)
      ->get();

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End DashboardMinicus'
    ]);

    return $dashboardcus;
  }
  /*
      * Create : Zar Ni(15/1/2022)
      * Update :
      * Explain of function : To get data for DashboardCuctomerCount
      * Prarameter : no
      * return :
    */
  public function Dashboardcuscount()
  {

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start Dashboardcuscount'
    ]);

    $cuscount = T_CU_Customer::where('t_cu_customer.del_flg', 0)
      ->count('t_cu_customer.id');

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End Dashboardcuscount'
    ]);

    return $cuscount;
  }
  /*
      * Create : Zar Ni(15/1/2022)
      * Update :
      * Explain of function : To get data for DashboardCuctomerCount
      * Prarameter : no
      * return :
    */
  public function customerInfoList()
  {

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start customerInfoList'
    ]);

    $customerlist = T_CU_Customer::select('*', DB::raw('t_cu_customer.id AS id'))
      ->leftjoin('m_state', 'm_state.id', '=', 't_cu_customer.address1')
      ->leftjoin('m_township', 'm_township.id', '=', 't_cu_customer.address2')
      ->where('t_cu_customer.del_flg', 0)
      ->orderBy('t_cu_customer.created_at', 'desc')
      ->paginate(10);

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End customerInfoList'
    ]);

    return $customerlist;
  }

  /*
      * Create : Zar Ni(20/1/2022)
      * Update :
      * Explain of function : To show customer search names
      * Prarameter : no
      * return :
    */
  public function cusSearch($request)
  {

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start cusSearch'
    ]);

    $cusSearch = T_CU_Customer::where('nickname', 'Like', '%' . $request->input('nickname') . '%')
      ->where('t_cu_customer.del_flg', 0)
      ->get();

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End cusSearch'
    ]);
    return $cusSearch;
  }

  /*
      * Create : Zar Ni(20/1/2022)
      * Update :
      * Explain of function : To show customer id search
      * Prarameter : no
      * return :
    */
  public function cusidSearch($request)
  {

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start cusidSearch'
    ]);

    $cusidSearch = T_CU_Customer::where('customerID', 'Like', '%' . $request->input('id') . '%')
      ->where('t_cu_customer.del_flg', 0)
      ->get();

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End cusidSearch'
    ]);

    return $cusidSearch;
  }
  /*
      * Create : Zar Ni(20/1/2022)
      * Update :
      * Explain of function : To show customer id search
      * Prarameter : no
      * return :
    */
  public function customerDetail($id)
  {

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start customerDetail'
    ]);

    $cusDetail = T_CU_Customer::select('*', DB::raw('t_cu_customer.id AS id'))
      ->leftjoin('m_state', 'm_state.id', '=', 't_cu_customer.address1')
      ->leftjoin('m_township', 'm_township.id', '=', 't_cu_customer.address2')
      ->where('t_cu_customer.del_flg', 0)
      ->where('t_cu_customer.id', '=', $id)
      ->first();
    // Log::critical('asdasd',[$cusDetail]);
    return $cusDetail;

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End customerDetail'
    ]);
  }
  /*
      * Create : Zar Ni(20/1/2022)
      * Update :
      * Explain of function : get nickname for sending email.
      * Prarameter : no
      * return :
    */
  public function suggestmailnickname($id)
  {
    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start suggestmailnickname'
    ]);
    $sugmail = T_CU_Customer::select('nickname')
      ->where('id', $id)
      ->first();

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End suggestmailnickname'
    ]);
    return $sugmail;
  }



  public function customerLogin()
  {
    return $this->hasOne('App\Models\M_CU_Customer_Login');
  }

  /*
      * Create : Linn Ko(20/1/2022)
      * Update :
      * Explain of function : To show customer search names
      * Prarameter : no
      * return :
    */
  public function searchByID($id)
  {
    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start searchByID'
    ]);

    $result = T_CU_Customer::where('customerID', $id)
      ->leftjoin('t_cu_coin_customer', 't_cu_coin_customer.customer_id', 't_cu_customer.id')
      ->where('t_cu_customer.del_flg', 0)
      ->first();

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End searchByID'
    ]);

    return $result;
  }

  /*
      * Create : Linn Ko(20/1/2022)
      * Update :
      * Explain of function : To show customer search names
      * Prarameter : no
      * return :
    */
  public function searchByCustomerID($id)
  {
    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'Start searchByCustomerID'
    ]);

    $result = T_CU_Customer::where('customerID', $id)
      ->where('del_flg', 0)
      ->first();

    Log::channel('adminlog')->info("T_CU_Customer Model", [
      'End searchByCustomerID'
    ]);

    return $result;
  }
}
