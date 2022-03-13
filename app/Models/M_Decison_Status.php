<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Decison_Status extends Model
{
    public $table = 'm_decision_status';
    use HasFactory;
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store Decision. (admin)
    */

    public function decisionStatusAdd($validate)
    {
        Log::channel('adminlog')->info("M_Decison_Status Model", [
            'Start decisionStatusAdd'
        ]);
        $admin = new M_Decison_Status();
        $admin->status = $validate['status'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("M_Decison_Status Model", [
            'End decisionStatusAdd'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to show Decision edit view.(admin)
   */

    public function decisionStatusEditView($id)
    {
        Log::channel('adminlog')->info("M_Decison_Status Model", [
            'Start decisionStatusEditView'
        ]);
        Log::channel('adminlog')->info("M_Decison_Status Model", [
            'End decisionStatusEditView'
        ]);
        return M_Decison_Status::find($id);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update Decision.(admin)
   */

    public function decisionStatusEdit($validate, $id)
    {
        Log::channel('adminlog')->info("M_Decison_Status Model", [
            'Start decisionStatusEdit'
        ]);
        $admin = M_Decison_Status::find($id);
        $admin->status = $validate['status'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("M_Decison_Status Model", [
            'End decisionStatusEdit'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update del_flg to 1.(admin)
   */
    public function decisionStatusDelete($id)
    {
        Log::channel('adminlog')->info("M_Decison_Status Model", [
            'Start decisionStatusDelete'
        ]);
        $admin = M_Decison_Status::find($id);
        $admin->del_flg = 1;
        $admin->save();
        Log::channel('adminlog')->info("M_Decison_Status Model", [
            'End decisionStatusDelete'
        ]);
    }
}
