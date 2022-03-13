<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Fav_Type extends Model
{
  public $table = 'm_fav_type';
  use HasFactory;
  /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store Favourite Type. (admin)
    */

  public function favTypeAdd($validate)
  {
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'Start favTypeAdd'
    ]);
    $admin = new M_Fav_Type();
    $admin->favourite_food = $validate['favourite_food'];
    $admin->note = $validate['note'];
    $admin->save();
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'End favTypeAdd'
    ]);
  }
  /*
  * Create:zayar(2022/01/15) 
  * Update: 
  * This function is used to show Favourite Type edit view. (admin)
  */

  public function favTypeEditView($id)
  {
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'Start favTypeEditView'
    ]);
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'End favTypeEditView'
    ]);
    return M_Fav_Type::find($id);
  }
  /*
  * Create:zayar(2022/01/15) 
  * Update: 
  * This function is used to update Favourite Type. (admin)
  */

  public function favTypeEdit($validate, $id)
  {
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'Start favTypeEdit'
    ]);
    $admin = M_Fav_Type::find($id);
    $admin->favourite_food = $validate['favourite_food'];
    $admin->note = $validate['note'];
    $admin->save();
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'End favTypeEdit'
    ]);
  }
  /*
  * Create:zayar(2022/01/15) 
  * Update: 
  * This function is used to update del_flg to 1. (admin)
  */
  public function favTypeDelete($id)
  {
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'Start favTypeDelete'
    ]);
    $admin = M_Fav_Type::find($id);
    $admin->del_flg = 1;
    $admin->save();
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'End favTypeDelete'
    ]);
  }
  /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to get all favourite type. (admin)
   */

  public function allType()
  {
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'Start allType'
    ]);
    return M_Fav_Type::where('del_flg', '=', 0)->get();
    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'End allType'
    ]);
  }

  /*
    * Create : Aung Min Khant(20/1/2022)
    * Update :
    * Explain of function : To get  all data from m_taste (admin)
    * parament : none
    * return get data
    * */
  public function getTypeAll()
  {

    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'Start all Data'
    ]);
    $mType = M_Fav_Type::all();

    Log::channel('adminlog')->info("M_Fav_Type Model", [
      'End all Data'
    ]);
    return  $mType;
  }
}
