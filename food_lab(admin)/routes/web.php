<?php
// use Cviebrock\EloquentTaggable\Models\Tag;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoinchargeTransaction;
use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BuycoinController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\FavtypeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SuggestController;
use App\Http\Controllers\TasteController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\customerInfoController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\CustomerProfileUpdate;
use App\Http\Controllers\DeliveryInfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TransactionController;
use Illuminate\Routing\RouteGroup;
use phpDocumentor\Reflection\DocBlock\Tag as DocBlockTag;
use PhpParser\Node\Expr\FuncCall;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

//_________________________________Admin Routes_________________________
*/
//admin login
Route::get('/admin', [AdminController::class, 'loginPage']);
Route::post('/admin', [AdminController::class, 'loginForm']);
// admin logout
Route::get('/adminlogout', [AdminController::class, 'logout']);
Route::group(['middleware' => ['checkAdmin']], function () {


  //admin role Check
  Route::group(['middleware' => ['checkadminRole']], function () {

    Route::get('coinchargeList', [CoinchargeTransaction::class, 'coinchargeList']);
    Route::get('orderTransaction', [OrderTransactionController::class, 'orderTransaction']);
    Route::get('ordertransactionDetail', [TransactionController::class, 'ordertransactionDetail']);
    Route::get('customerinfoDetail', [customerInfoController::class, 'customerinfoDetail']);
    //_________________________________Chart Routes_________________________
    /**
     * For Daily SalesChart show
     */
    Route::get('dailyChart', [SalesController::class, 'dailyChart']);

    /**
     * For Monthly SalesChart show
     */
    Route::get('monthlyChart', [SalesController::class, 'monthlyChart']);

    /**
     * For Yearly SalesChart show
     */
    Route::get('yearlyChart', [SalesController::class, 'yearlyChart']);

    /**
     * For Range Chart show
     */
    Route::get('rangeChart', function () {
      return  view('admin.salesChart.rangeSale', ['order' => '', 'coin' => '', 'orderArray' => [], 'coinArray' => [], 'orderDaily' => [], 'coinDaily' => []]);
    });

    Route::post('rangeChart', [SalesController::class, 'rangeChart']);

    //admin/setting/loginManage
    Route::resource('adminLogin', LoginController::class);
    //admin/setting/coinRate
    Route::resource('coinrate', CoinController::class);
    //admin/setting/siteManage
    Route::get('siteManage', [SiteController::class, 'siteManage']);
    Route::post('siteManage/store', [SiteController::class, 'store']);
    //admin/setting/appManage
    //_________________________________start loginManage_________________________/

    Route::resource('adminLogin', LoginController::class);

    //_________________________________end loginManage_________________________/

    //_________________________________start coinManage_________________________/

    Route::resource('coinrate', CoinController::class);

    //_________________________________end coinManage_________________________/

    //_________________________________start siteManage_________________________/

    Route::get('siteManage', [SiteController::class, 'siteManage']);
    Route::post('siteManage/store', [SiteController::class, 'store']);

    //_________________________________end siteManage_________________________/

    //_________________________________start appManage_________________________/

    Route::resource('app', AppController::class);
    Route::resource('township', TownshipController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('taste', TasteController::class);
    Route::resource('suggestAdmin', SuggestController::class);
    Route::resource('favtype', FavtypeController::class);
    Route::resource('orderstatus', OrderStatusController::class);
    Route::resource('decision', DecisionController::class);
    Route::resource('slider', SliderController::class);
    //admin/setting/newsManage
    Route::resource('news', NewsController::class);

    Route::get('adminValidate/{id}', [AdminController::class, 'adminValidate']);
    //_________________________________end appManage_________________________/

    //_________________________________start newsManage_________________________/

    Route::resource('news', NewsController::class);

    //_________________________________end newsManage_________________________/
    //admin/setting/coinRate
    Route::resource('coinrate', CoinController::class);
  });
  //Admin role check end

  /**
   * For Dashboard & Transaction
   */
  Route::get('dashboard', [DashboardController::class, 'dashboardList']);


  /**
   * Customer Info
   */
  Route::get('customerInfo', [customerInfoController::class, 'customerInfo']);
  Route::get('searchname', [customerInfoController::class, 'customerSearch']);
  Route::get('searchid', [customerInfoController::class, 'customeridSearch']);

  /**
   * Customer Report
   */
  Route::get('customerReport', [NotificationController::class, 'customerReport']);
  Route::post('reportrp/{id}', [NotificationController::class, 'reportRp']);
  Route::get('reportreplies', [NotificationController::class, 'customerreportReply']);

  /**
   * 
   * Download File
   */
  Route::get('downloadCsvFile', [NotificationController::class, 'downloadCsvFile']);
  /**
   * 
   * Customer Contact
   */
  Route::get('customerContact', [NotificationController::class, 'customerContact']);
  Route::post('conrp/{id}', [NotificationController::class, 'contrpy']);
  Route::get('contactreplies', [NotificationController::class, 'customercontactReply']);
  /**
   * Customer Suggest
   */
  Route::get('customerSuggest', [NotificationController::class, 'customerSuggest']);
  Route::post('sugrp/{id}', [NotificationController::class, 'cusRpy']);
  Route::get('suggestreplies', [NotificationController::class, 'customersuggestReply']);
  /**
   * For Product Form page
   */
  Route::resource('product', ProductController::class);
  //Prouduct List
  Route::get('productList', [ProductListController::class, 'showList']);

  //For customer home page
  Route::get('/', [CustomerController::class, 'foodlab']);
  //admin/setting/loginManage
  Route::resource('adminLogin', LoginController::class);




  //_________________________________Start Admin Coin Routes_________________________

  Route::get('coinListing', [CoinController::class, 'list']);
  Route::get('rateHistory', [CoinController::class, 'rateHistory']);
  Route::get('rateChange', [CoinController::class, 'rateChange']);
  Route::post('rateStore', [CoinController::class, 'rateStore']);
  Route::get('makeDecision/{id}', [CoinController::class, 'decision']);
  Route::post('decided', [CoinController::class, 'makeDecision']);
  Route::get('makeReDecision/{id}', [CoinController::class, 'reDecision']);
  Route::post('redecided', [CoinController::class, 'makeReDecision']);
  Route::get('detailCharge/{id}', [CoinController::class, 'detailCharge']);
  Route::get('addCoin', [CoinController::class, 'addCoin']);
  Route::post('searchCustomer', [CoinController::class, 'searchCustomer']);
  Route::post('addCoinCustomer', [CoinController::class, 'addCoinCustomer']);

  //_________________________________End Admin Coin Routes_________________________

});
