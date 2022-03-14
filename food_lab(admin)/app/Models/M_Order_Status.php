<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Order_Status extends Model
{
    public $table = 'm_order_status';
    use HasFactory;

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store Order Status. (admin)
    */

    public function orderStatusAdd($validate)
    {
        Log::channel('adminlog')->info("M_Order_Status Model", [
            'Start orderStatusAdd'
        ]);
        $admin = new M_Order_Status();
        $admin->status = $validate['status'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("M_Order_Status Model", [
            'End orderStatusAdd'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to show Order Status edit view. (admin)
   */

    public function orderStatusEditView($id)
    {
        Log::channel('adminlog')->info("M_Order_Status Model", [
            'Start orderStatusEditView'
        ]);
        Log::channel('adminlog')->info("M_Order_Status Model", [
            'End orderStatusEditView'
        ]);
        return M_Order_Status::find($id);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update Order Status. (admin)
   */

    public function orderStatusEdit($validate, $id)
    {
        Log::channel('adminlog')->info("M_Order_Status Model", [
            'Start orderStatusEdit'
        ]);
        $admin = M_Order_Status::find($id);
        $admin->status = $validate['status'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("M_Order_Status Model", [
            'End orderStatusEdit'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update del_flg to 1. (admin)
   */
    public function orderStatusDelete($id)
    {
        Log::channel('adminlog')->info("M_Order_Status Model", [
            'Start orderStatusDelete'
        ]);

        $admin = M_Order_Status::find($id);
        $admin->del_flg = 1;
        $admin->save();
        Log::channel('adminlog')->info("M_Order_Status Model", [
            'End orderStatusDelete'
        ]);
    }
}
