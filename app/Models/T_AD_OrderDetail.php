<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_OrderDetail extends Model
{
    public $table = 't_ad_orderdetail';
    use HasFactory;

    /*
    * Create : Min Khant(14/1/2022)
    * Update :
    * Explain of function : To get product data
    * Prarameter : no
    * return : 
    */
    public function productId($id)
    {
        Log::channel('customerlog')->info('T_AD_OrderDetail Model', [
            'start productId'
        ]);
        $productIds = T_AD_OrderDetail::select('product_id')
            ->where('order_id', '=', $id)
            ->where('del_flg', '=', 0)
            ->get();

        return $productIds;
    }
    /*
    * Create : Zar Ni(14/1/2022)
    * Update :
    * Explain of function : Product data for OrderTransaction Detail
    * Prarameter : no
    * return : 
    */
    public function orderDetail($id)
    {
        Log::channel('adminlog')->info("T_AD_OrderDetail Model", [
            'Start orderDetail'
        ]);

        $orderDetail = T_AD_OrderDetail::where('t_ad_orderdetail.order_id', '=', $id)
            ->join('m_product', 'm_product.id', '=', 't_ad_orderdetail.product_id')
            ->where('t_ad_orderdetail.del_flg', 0)
            ->paginate(5);

        Log::channel('adminlog')->info("T_AD_OrderDetail Model", [
            'End orderDetail'
        ]);

        return $orderDetail;
    }
    /*
    * Create : Zar Ni (14/1/2022)
    * Update :
    * Explain of function : To get Top 3 product
    * Prarameter : no
    * return : 
    */

    public function topthree()
    {
        Log::channel('adminlog')->info("T_AD_OrderDetail Model", [
            'Start topthree'
        ]);
        $top = T_AD_OrderDetail::select('product_id', 'product_name', DB::raw('count(*) AS count'))
            ->join('m_product', 'm_product.id', '=', 't_ad_orderdetail.product_id')
            ->where('t_ad_orderdetail.del_flg', 0)
            ->where('m_product.del_flg', 0)
            ->groupBy('product_id')
            ->limit(3)
            ->orderBy('count', 'DESC')
            ->get();
        Log::channel('adminlog')->info("T_AD_OrderDetail Model", [
            'End topthree'
        ]);
        return $top;
    }
}
