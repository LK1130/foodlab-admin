<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Common\Variable;

class T_AD_Photo extends Model
{
    use HasFactory;
    public $table = 't_ad_photo';


    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : To save product image to t_av_evd database (admin)
    * parament : request from product add form
    * return save data
    * */

    public function insertImage($filepath, $product, $order)
    {

        $commonVar = new Variable();
        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'Start save Data'
        ]);

        Log::critical("session 1", [session($order), $order]);
        if (session($order) != "") {
            $phd = T_AD_Photo::where('link_id', '=', $product->id)
                ->where('order_id', '=', $order)
                ->update(['del_flg' => 1]);
        }

        $phd = new T_AD_Photo();

        $phd->link_id = $product->id;
        $phd->order_id = $order;
        $phd->path = $commonVar->STORAGE_PREFIX. $filepath;
        $phd->note = "Product Image";
        $phd->save();

        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'End save Data'
        ]);
    }

    /*
    * Create : Aung Min Khant(20/1/2022)
    * Update :
    * Explain of function : To restore product image from t_av_evd database (admin)
    * parament : specific id  from m_product database
    * return  data
    * */
    public function editEvd($id)
    {

        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'Start edit Data'
        ]);
        $phd = DB::select(
            DB::raw("SELECT
            t_ad_photo.path
            FROM
            t_ad_photo
            WHERE
            t_ad_photo.link_id = $id AND
            t_ad_photo.del_flg = 0 
            ORDER BY
            t_ad_photo.order_id")
        );

        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'End edit Data'
        ]);
        return $phd;
    }

    public function getPhoto($order, $product)
    {
        $photo = T_AD_Photo::where('link_id', '=', $product)
            ->where('order_id', '=', $order)
            ->where('del_flg', '=', 0)
            ->first();

        return $photo ? $photo : "";
    }

    public function deleteImage($id)
    {

        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'Start delete image'
        ]);
        T_AD_Photo::where('link_id', $id)
            ->update(['del_flg' => 1]);

        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'End delete image'
        ]);
    }

    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : To update product image to t_av_evd database
    * parament : request from product add form
    * return update data
    * */
    public function updateImage($id, $filepath)
    {
        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'Start update Data'
        ]);
        $evd = T_AD_Photo::where('t_ad_photo.link_id', '=', $id)
            ->where('t_ad_photo.path', '=', $filepath)
            ->get();
        $evd->path = $filepath;
        $evd->save();

        Log::channel('adminlog')->info("T_AD_Photo  Model", [
            'End update Data'
        ]);
    }
}
