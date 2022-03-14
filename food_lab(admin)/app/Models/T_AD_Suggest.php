<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_Suggest extends Model
{
    public $table = 't_ad_suggest';
    use HasFactory;


    /*
   * Create:Zar Ni(2022/01/22) 
   * Update: 
   * This function is Show data of Customer Suggest List.
   */

    public function customerSuggestList()
    {

        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'Start customerSuggestList'
        ]);

        $suggest = T_AD_Suggest::select('*', DB::raw('t_ad_suggest.id AS ID'))
            ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_suggest.customer_id')
            ->join('m_suggest', 'm_suggest.id', '=', 't_ad_suggest.suggest_type')
            ->where('t_ad_suggest.del_flg', 0)
            ->paginate(10);

        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'End customerSuggestList'
        ]);
        return $suggest;
    }
    /*
   * Create:Zar Ni(2022/01/22) 
   * Update: 
   * This function is Show data of Customer Suggest Count.
   */
    public function suggestcount()
    {

        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'Start suggestcount'
        ]);

        $sugcount = T_AD_Suggest::where('t_ad_suggest.reply', null)
            ->where('t_ad_suggest.del_flg', 0)
            ->count('t_ad_suggest.id');

        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'End suggestcount'
        ]);
        return $sugcount;
    }
    /*
   * Create:Zar Ni(2022/01/22) 
   * Update: 
   * This function is Show data of Customer Suggest Reply.
   */
    public function suggestReply($id)
    {

        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'Start suggestReply'
        ]);

        $reply = T_AD_Suggest::select('*', DB::raw('t_ad_suggest.id AS ID'))
            ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_suggest.customer_id')
            ->join('m_suggest', 'm_suggest.id', '=', 't_ad_suggest.suggest_type')
            ->where('t_ad_suggest.id', '=', $id)
            ->where('t_ad_suggest.del_flg', 0)
            ->first();

        return $reply;

        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'End suggestReply'
        ]);
    }

    /*
   * Create:Zar Ni(2022/01/25) 
   * Update: 
   * This function is for reply to customer.
   */
    public function sugRpy($id, $request)
    {

        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'Start sugRpy'
        ]);

        $rp = T_AD_Suggest::where('id', $id)
            ->update(['reply' => $request]);

        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'End sugRpy'
        ]);
        return $rp;
    }
    /*
   * Create:Zar Ni(2022/01/25) 
   * Update: 
   * This function is for send emal to customer.
   */
    public function cussuggestMail($id)
    {
        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'Start cussuggestMail'
        ]);
        $sugmail = T_AD_Suggest::select(['customer_id', 'reply', 'message'])
            ->where('id', $id)
            ->first();
        Log::channel('adminlog')->info("T_AD_Suggest Model", [
            'End cussuggestMail'
        ]);
        return $sugmail;
    }
}
