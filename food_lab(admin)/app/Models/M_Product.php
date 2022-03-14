<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Product extends Model
{
    use HasFactory;
    public $table = 'm_product';

    /* Create : Aung Min Khant(21/1/2022)
    * Update :
    * Explain of function : To getall data from m_product databse and m_fav_type and m_taste (admin)
    * parament : none
    * return all data
    * */

    public function getAllProducts()
    {
        Log::channel('adminlog')->info("M_Product Model", [
            'Start getAllProducts'
        ]);
        $product = DB::table('m_product')
            ->select('*', DB::raw('m_product.id AS pid'))
            ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
            ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
            ->where('m_product.del_flg', 0)
            ->orderBy('avaliable', 'DESC')
            ->paginate(10);

        Log::channel('adminlog')->info("M_Product Model", [
            'End getAllProducts'
        ]);

        return $product;
    }

    /*
    * Create : Aung Min Khant(18/1/2022)
    * Update :
    * Explain of function : To save data for m_product databse (admin)
    * parament : request from product add form
    * return save data
    * */
    public function saveData($request)
    {

        Log::channel('adminlog')->info("M_Product_ Model", [
            'Start save Data'
        ]);

        $mrate = new M_AD_CoinRate();
        $rates = $mrate->getRate();
        $amount = $request->input('coin') * $rates->rate;
        $product = new M_Product();
        $product->product_name = $request->input('pname');
        $product->product_type = $request->input('ptype');
        $product->product_taste = $request->input('ptaste');
        $product->coin = $request->input('coin');
        $product->amount = $amount;
        $product->list = $request->input('list');
        $product->description = $request->input('pdesc');
        $product->avaliable = $request->has('avaliable') ? 1 : 0;
        $product->save();


        Log::channel('adminlog')->info("M_Product Model", [
            'End save data'
        ]);
        return $product;
    }

    /*
    * Create : Aung Min Khant(22/2/2022)
    * Update :
    * Explain of function : To change amount when admin change rate (admin)
    * parament : none
    * return change amount
    * */
    public function changeAmount($rate)
    {

        Log::channel('adminlog')->info("M_Product Model", [
            'Start changeAmount'
        ]);

        $product = DB::select(
            DB::raw("
            UPDATE
            m_product
            SET
            amount = coin * $rate
            ")
        );

        Log::channel('adminlog')->info("M_Product Model", [
            'End changeAmount'
        ]);
    }


    /*
    * Create : Aung Min Khant(20/1/2022)
    * Update :
    * Explain of function : To get  data with specific id from m_product databse (admin)
    * parament : specific id from  product list table
    * return get data
    * */
    public function getDataById($id)
    {

        Log::channel('adminlog')->info("M_Product_ Model", [
            'Start getDataById'
        ]);
        $mProduct = M_Product::findOrfail($id);

        Log::channel('adminlog')->info("M_Product_ Model", [
            'End get DataById'
        ]);
        return $mProduct;
    }
    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : To update data for m_product databse (admin)
    * parament : request from product edit form
    * return update data
    * */

    public function updateData($request, $id)
    {
        Log::channel('adminlog')->info("M_Product Model", [
            'Start updateData'
        ]);

        $mrate = new M_AD_CoinRate();
        $rates = $mrate->getRate();
        $amount = $request->input('coin') * $rates->rate;
        $product = M_Product::find($id);
        $product->product_name = $request->input('pname');
        $product->product_type = $request->input('ptype');
        $product->product_taste = $request->input('ptaste');
        $product->coin = $request->input('coin');
        $product->amount = $amount;
        $product->list = $request->input('list');
        $product->description = $request->input('pdesc');
        $product->avaliable = $request->has('avaliable') ? 1 : 0;
        $product->save();

        Log::channel('adminlog')->info("M_Product Model", [
            'End updateData'
        ]);


        return $product;
    }

    /*
      * Create : Zar Ni(15/1/2022)
      * Update :
      * Explain of function : To get data for DashboardProductMiniList
      * Prarameter : no
      * return :
    */
    public function DashboardproductList()
    {

        Log::channel('adminlog')->info("M_Product Model", [
            'Start DashboardproductList'
        ]);

        $dashboardproduct = M_Product::join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
            ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
            ->limit(5)
            ->get();

        Log::channel('adminlog')->info("M_Product Model", [
            'End DashboardproductList'
        ]);

        return $dashboardproduct;
    }

    public function productDetail()
    {

        return $this->hasMany('App\Models\M_Product_Detail');
    }
}
