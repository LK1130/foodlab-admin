<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_Evd extends Model
{
    use HasFactory;
    public $table = 't_ad_evd';


    // /*
    // * Create : Aung Min Khant(19/1/2022)
    // * Update :
    // * Explain of function : To save product image to t_av_evd database
    // * parament : request from product add form
    // * return save data
    // * */

    // public function insertImage($filepath, $product,$order)
    // {

    //     Log::channel('adminlog')->info("T_AD_EVD Model", [
    //         'Start save Data'
    //     ]);

    //     Log::critical("session 1",[session($order),$order]);
    //         if(session($order) != ""){
    //             $evd = T_AD_Evd::where('link_id','=',$product->id)
    //             ->where('order_id','=',$order)
    //             ->update(['del_flg' => 1]);
                
    //         }

    //     $evd = new T_AD_Evd();

    //     $evd->link_id = $product->id;
    //     $evd->order_id = $order;
    //     $evd->path = $filepath;
    //     $evd->note = "Product Image";
    //     $evd->save();

    //     Log::channel('adminlog')->info("T_AD_EVD Model", [
    //         'End save Data'
    //     ]);
    // }

    // /*
    // * Create : Aung Min Khant(20/1/2022)
    // * Update :
    // * Explain of function : To restore product image from t_av_evd database
    // * parament : specific id  from m_product database
    // * return  data
    // * */
    // public function editEvd($id)
    // {

    //     Log::channel('adminlog')->info("T_AD_EVD Model", [
    //         'Start edit Data'
    //     ]);
    //     $evd = DB::select(
    //         DB::raw("SELECT
    //         t_ad_evd.path
    //         FROM
    //         t_ad_evd
    //         WHERE
    //         t_ad_evd.link_id = $id AND
    //         t_ad_evd.del_flg =0 
    //         ORDER BY
    //         t_ad_evd.order_id")
    //     );

    //     Log::channel('adminlog')->info("T_AD_EVD Model", [
    //         'End edit Data'
    //     ]);
    //     return $evd;
    // }

    // public function getPhoto($order,$product){
    //     $photo = T_AD_Evd::where('link_id','=',$product)
    //         ->where('order_id','=',$order)
    //         ->where('del_flg','=',0)
    //         ->first();

    //     return $photo ? $photo : "";
    // }

    // public function deleteImage($id)
    // {

    //     Log::channel('adminlog')->info("T_AD_EVD Model", [
    //         'Start delete image'
    //     ]);
    //     T_AD_Evd::where('link_id', $id)
    //         ->update(['del_flg' => 1]);

    //     Log::channel('adminlog')->info("T_AD_EVD Model", [
    //         'End delete image'
    //     ]);
    // }

    // /*
    // * Create : Aung Min Khant(19/1/2022)
    // * Update :
    // * Explain of function : To update product image to t_av_evd database
    // * parament : request from product add form
    // * return update data
    // * */


    // public function updateImage($id, $filepath)
    // {
    //     Log::channel('adminlog')->info("T_AD_EVD Model", [
    //         'Start update Data'
    //     ]);
    //     $evd = T_AD_Evd::where('t_ad_evd.link_id', '=', $id)
    //         ->where('t_ad_evd.path', '=', $filepath)
    //         ->get();
    //     $evd->path = $filepath;
    //     $evd->save();

    //     Log::channel('adminlog')->info("T_AD_EVD Model", [
    //         'End update Data'
    //     ]);
    // }

    /*
    * Create : Zaw Phyo(28/1/2022)
    * Update :
    * Explain of function : Foreign Key Link to T_AD_CoinCharge
    * return 
    */

    public function coinChargeconnect(){
        return $this->hasOne("App\Models\T_AD_CoinCharge");
    }

}
