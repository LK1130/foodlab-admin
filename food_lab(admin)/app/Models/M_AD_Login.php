<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class M_AD_Login extends Model
{
    public $table = 'm_ad_login';
    use HasFactory;

    /*
      * Create : Min Khant(20/1/2022)
      * Update :
      * Explain of function : To check admin login username
      * Prarameter : Username
      * return : username
    */
    public function checkUsernamae($name)
    {
        Log::channel('adminlog')->info('M_AD_Login Model', [
            'start checkUsernamae'
        ]);
        $hasName = M_AD_Login::where('ad_name', '=', $name)->get();

        Log::channel('adminlog')->info('M_AD_Login Model', [
            'end checkUsernamae'
        ]);
        return $hasName;
    }

    /*
      * Create : Min Khant(20/1/2022)
      * Update :
      * Explain of function : To check admin login password
      * Prarameter : Username
      * return : admin id
    */
    public function checkPassword($name, $password)
    {
        Log::channel('adminlog')->info('M_AD_Login Model', [
            'start checkPassword'
        ]);

        $hasAccount = M_AD_Login::select(['id', 'ad_role', 'ad_name'])
            ->where('ad_name', $name)
            ->where('ad_password', md5(sha1($password)))
            ->where('ad_valid', 1)
            ->first();

        Log::channel('adminlog')->info('M_AD_Login Model', [
            'end checkPassword'
        ]);

        return $hasAccount;
    }

    /*
      * Create : Min Khant(20/1/2022)
      * Update :
      * Explain of function : if login complete,to update ad_login_dt
      * Prarameter : id
      * return : 
    */
    public function updateLoginTime($id)
    {
        Log::channel('adminlog')->info('M_AD_Login Model', [
            'start updateLoginTime'
        ]);

        $updateTime = M_AD_Login::where('id', '=', $id)
            ->update(['ad_login_dt' => now()]);

        Log::channel('adminlog')->info('M_AD_Login Model', [
            'end updateLoginTime'
        ]);
        return true;
    }

    /*
    * Create:zayar(2022/01/11) 
    * Update: 
    * This is method is used to save admin in database.
    * $validate is validated user request.
    * $admin is AdminLogin model.
    * $admins is all admin from database. (admin)
    * Return is view (adminList.blade.php).
    */
    public function AdminAdd($validate)
    {
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'Start AdminAdd'
        ]);
        $admin = new M_AD_Login();
        $admin->ad_name = $validate['username'];
        $admin->ad_password = md5(sha1($validate['password']));
        $admin->ad_role = $validate['role'];
        $admin->ad_valid = $validate['validate'];
        $admin->ad_login_dt = Carbon::now();
        $admin->save();
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'End AdminAdd'
        ]);
    }
    /*
   * Create:zayar(2022/01/11) 
   * Update: 
   * This is method is used to show admin form database in table.
   * $admins is all admin from database.
   * Return is view (adminList.blade.php).
   */
    public function AdminList()
    {
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'Start AdminList'
        ]);
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'End AdminList'
        ]);
        return M_AD_Login::where('del_flg', '=', 0)->paginate(3);
    }
    /*
   * Create:zayar(2022/01/11) 
   * Update: 
   * This method is used to show user clicked admin form database.
   * $id is admin id.
   * $admins is admin from database which match with $id. (admin)
   * Return is view (adminList.blade.php).
   */
    public function AdminDetail($id)
    {
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'Start AdminDetail'
        ]);
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'End AdminDetail'
        ]);
        return M_AD_Login::find($id);
    }
    /*
   * Create:zayar(2022/01/11) 
   * Update: 
   * This is method is used to show Admin Edit View. (admin)
   * $id is admin id.
   * Return is view (adminList.blade.php).
   */
    public function AdminEdit($id)
    {
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'Start AdminEdit'
        ]);
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'End AdminEdit'
        ]);
        return M_AD_Login::find($id);
    }
    /*
   * Create:zayar(2022/01/11) 
   * Update: 
   * This is method is used to update Admin informations.
   * $id is admin id.
   * $validate is validated user request. (admin)
   * Return is view (adminList.blade.php).
   */
    public function AdminUpdate($validate, $id)
    {
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'Start AdminUpdate'
        ]);
        $admin = M_AD_Login::find($id);
        $admin->ad_name = $validate['username'];
        $admin->ad_password =  md5(sha1($validate['password']));
        $admin->ad_role = $validate['role'];
        $admin->ad_valid = $validate['validate'];
        $admin->save();
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'End AdminUpdate'
        ]);
    }
    /*
   * Create:zayar(2022/01/11) 
   * Update: 
   * This is method is used to update del_flg.
   * $id is admin id. (admin)
   * Return is view (adminList.blade.php).
   */
    public function AdminDelete($id)
    {
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'Start AdminDelete'
        ]);
        $admin = M_AD_Login::find($id);
        $admin->del_flg = 1;
        $admin->save();
        Log::channel('adminlog')->info("M_AD_Login Model", [
            'End AdminDelete'
        ]);
    }

    /*
   * Create:zayar(2022/01/11) 
   * Update: 
   * This is method is used to update del_flg.
   * $id is admin id. (admin)
   * Return is view (adminList.blade.php).
   */
    public function adminValidate($request)
    {

        Log::channel('adminlog')->info("T_CU_Customer Model", [
            'Start adminValidate'
        ]);

        $admin = M_AD_Login::find($request->input('id'));
        $admin->ad_valid = 0;
        $admin->save();

        Log::channel('adminlog')->info("T_CU_Customer Model", [
            'End adminValidate'
        ]);
    }
}
