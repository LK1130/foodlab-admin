<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Suggest extends Model
{
    public $table = 'm_suggest';
    use HasFactory;

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store suggest. (admin)
    */

    public function suggestAdd($validate)
    {
        Log::channel('adminlog')->info("M_Suggest Model", [
            'Start suggestAdd'
        ]);
        $admin = new M_Suggest();
        $admin->suggest_type = $validate['suggest_type'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("M_Suggest Model", [
            'End suggestAdd'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to show suggest edit view. (admin)
   */

    public function suggestEditView($id)
    {
        Log::channel('adminlog')->info("M_Suggest Model", [
            'Start suggestEditView'
        ]);
        Log::channel('adminlog')->info("M_Suggest Model", [
            'End suggestEditView'
        ]);
        return M_Suggest::find($id);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update suggest. (admin)
   */

    public function suggestEdit($validate, $id)
    {
        Log::channel('adminlog')->info("M_Suggest Model", [
            'Start suggestEdit'
        ]);
        $admin = M_Suggest::find($id);
        $admin->suggest_type = $validate['suggest_type'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("M_Suggest Model", [
            'End suggestEdit'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update del_flg to 1. (admin)
   */
    public function suggestDelete($id)
    {
        Log::channel('adminlog')->info("M_Suggest Model", [
            'Start suggestDelete'
        ]);
        $admin = M_Suggest::find($id);
        $admin->del_flg = 1;
        $admin->save();
        Log::channel('adminlog')->info("M_Suggest Model", [
            'End suggestDelete'
        ]);
    }
}
