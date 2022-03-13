<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_AD_CoinRate;
use App\Models\M_Product;
use App\Models\M_Site;
use App\Models\M_Township;
use App\Models\T_AD_Photo;
use App\Models\T_CU_Customer;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\returnSelf;

class CartController extends Controller
{

    /*
     * Create :Aung Min Khant(9/2/2022)
     * Update :
     * Explain of function : get session count from view page
     * Prarameter : request from ajax
     * return :
     * */

    public function getSessionCount(Request $request)
    {

        Log::channel('customerlog')->info('CartController', [
            'start getSessionCount'
        ]);

        $products = $request->data;
        session(['cart' => $products]);


        Log::channel('customerlog')->info('CartController', [
            'end getSessionCount'
        ]);

        // return session('cart');
    }
}
