<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Product_Detail extends Model
{
    use HasFactory;
    public $table = 'm_product_detail';

    /*
    * Create : Aung Min Khant(17/1/2022)
    * Update :
    * Explain of function : To insert data for m_product_detail base (admin)
    * parameter : $request form product,category,label,order and value 
    * return insert data to database
    * */


    public function insert($product, $category, $label, $order, $value)
    {

        Log::channel('adminlog')->info("M_Product_Detail Model", [
            'Start Insert'
        ]);
        $product_detail = new M_Product_Detail();
        $product_detail->category = $category;
        $product_detail->label = $label;
        $product_detail->order = $order;
        $product_detail->value = $value;
        $product_detail->product_id = $product->id;
        $product_detail->save();

        Log::channel('adminlog')->info("M_Product_Detail Model", [
            'End Insert'
        ]);
    }

    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : to restore data for request by speciic id from  m_product_detail database (admin)
    * parameter : $request id from product list table
    * return restore data to request form
    * */

    public function editData($id)
    {

        Log::channel('adminlog')->info("M_Product_Detail Model", [
            'Start editdata'
        ]);

        $mProductDetail = DB::select(
            DB::raw("SELECT
            m_product_detail.category,m_product_detail.label,GROUP_CONCAT(m_product_detail.value) as value
        FROM
            m_product_detail
        WHERE
            m_product_detail.product_id = $id AND
            m_product_detail.del_flg = 0
        
        GROUP BY
            m_product_detail.label
         ORDER BY 
            m_product_detail.id     
        ")
        );

        Log::channel('adminlog')->info("M_Product_Detail Model", [
            'End editdata'
        ]);

        return $mProductDetail;
    }


    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : to delete data for request by specific id from  m_product_detail database (admin)
    * parameter : $request id from product list table
    * return restore data to request form
    * */

    public function deleteData($id)
    {

        Log::channel('adminlog')->info("M_Product_Detail Model", [
            'Start delete data'
        ]);
        M_Product_Detail::where('product_id', $id)
            ->update(['del_flg' => 1]);

        Log::channel('adminlog')->info("M_Product_Detail Model", [
            'End delete data'
        ]);
    }

    public function product()
    {

        return $this->belongsTo('App\Models\Product');
    }
}
