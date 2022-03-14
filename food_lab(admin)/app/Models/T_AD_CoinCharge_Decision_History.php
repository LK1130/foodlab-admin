<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_CoinCharge_Decision_History extends Model
{

    public $table = 't_ad_coincharge_decision_history';
    use HasFactory;

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set coin finance.
    * Parameters : no
    * Return : photo path
    */
    public function setDecisionHistory($chargeid, $oldStatus, $newStatus, $note)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Decision_History Model", [
            'Start setDecisionHistory'
        ]);

        $history = new T_AD_CoinCharge_Decision_History();
        $history->charge_id = $chargeid;
        $history->decision_by = session('adminId');
        $history->old_status = $oldStatus;
        $history->new_status = $newStatus;
        $history->note = $note;
        $history->save();

        Log::channel('adminlog')->info("T_AD_CoinCharge_Decision_History Model", [
            'End setDecisionHistory'
        ]);
    }

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to find charge Id in history.
    * Parameters : no
    * Return : result
    */
    public function findHistoryById($chargeid)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Decision_History Model", [
            'Start findHistoryById'
        ]);

        $result = T_AD_CoinCharge_Decision_History::select(
            '*',
            DB::raw(
                '
        (SELECT status 
        FROM `m_decision_status` 
        where id = old_status AND
        del_flg =0) AS old'
            ),
            DB::raw('
        (SELECT status 
        FROM `m_decision_status` 
        where id = new_status AND
        del_flg =0) AS new')
        )

            ->join('m_ad_login', 'm_ad_login.id', '=', 't_ad_coincharge_decision_history.decision_by')
            ->where('t_ad_coincharge_decision_history.del_flg', 0)
            ->where('t_ad_coincharge_decision_history.charge_id', $chargeid)
            ->orderBy('t_ad_coincharge_decision_history.updated_at', 'DESC')
            ->get();

        Log::channel('adminlog')->info("T_AD_CoinCharge_Decision_History Model", [
            'End findHistoryById'
        ]);

        return $result;
    }
}
