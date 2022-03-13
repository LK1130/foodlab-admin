<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_Product;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductListController extends Controller
{

    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : To show table data from M_Product datbase (admin)
    * parameter : none
    * return all data 
    * */
    public function showList()
    {

        Log::channel('adminlog')->info("ProductList Controller", [
            'Start showList'
        ]);
        $mproduct = new M_Product();
        $product = $mproduct->getAllProducts();

        Log::channel('adminlog')->info("ProductList Controller", [
            'End showList'
        ]);
        return View('admin.product.productList', ['products' => $product]);
    }


    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : To validate label and value  from request (admin)
    * parament : all requestes from  product form
    * return :  validate label and value
    * */

    public function checkCategory($request)
    {
        if ($request->has('category1')) {
            $request->validate([
                'pdname1' => 'required',
                'pdvalue1' => 'required',
            ]);
        }
        if ($request->has('category2')) {
            $request->validate([
                'pdname2' => 'required',
                'pdvalue2' => 'required',
            ]);
        }
        if ($request->has('category3')) {
            $request->validate([
                'pdname3' => 'required',
                'pdvalue3' => 'required',
            ]);
        }

        if ($request->has('category4')) {
            $request->validate([
                'pdname4' => 'required',
                'pdvalue4' => 'required',
            ]);
        }

        if ($request->has('category5')) {
            $request->validate([
                'pdname5' => 'required',
                'pdvalue5' => 'required',
            ]);
        }
        if ($request->has('category6')) {
            $request->validate([
                'pdname6' => 'required',
                'pdvalue6' => 'required',
            ]);
        }
    }
}
