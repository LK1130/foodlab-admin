<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginValidation;
use App\Models\M_AD_Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    /*
      * Create : Min Khant(20/1/2022)
      * Update :
      * Explain of function : For call view admin login page
      * Prarameter : no
      * return : View admin login Blade
    */
    public function loginPage()
    {
        Log::channel('adminlog')->info('AdminController', [
            'start loginPage'
        ]);

        Log::channel('adminlog')->info('AdminController', [
            'end loginPage'
        ]);

        return view('admin.adminLogin');
    }


    /*
      * Create : Min Khant(20/1/2022)
      * Update : zayar(31/1/2022)
      * Explain of function : To check admin login username and password
      * Prarameter : $request
      * return : redirect dashboard
    */
    public function loginForm(AdminLoginValidation $request)
    {
        Log::channel('adminlog')->info('AdminController', [
            'start loginForm'
        ]);

        Log::channel('adminlog')->info('AdminController', [
            'end loginForm'
        ]);

        return redirect('/dashboard');
    }

    /*
      * Create : Min Khant(20/1/2022)
      * Update :
      * Explain of function : To delete session data 
      * Prarameter : $request
      * return : redirect view admin blade
    */
    public function logout()
    {
        Log::channel('adminlog')->info('AdminController', [
            'start logout'
        ]);

        session()->forget('adminId');
        session()->forget('role');

        Log::channel('adminlog')->info('AdminController', [
            'end logout'
        ]);
        return redirect('/admin');
    }
    /*
    * Create:zayar(2022/02/01) 
    * Update: 
    * This is function is to validate admin.
    * $id is used searching this adminid.
    * Return is view (adminList.blade.php)
    */
    public  function adminValidate(Request $request, $id)
    {

        Log::channel('adminlog')->info("AdminController", [
            'Start adminValidate'
        ]);
        $admin = new M_AD_Login();
        $admin->adminValidate($id);
        Log::channel('adminlog')->info("AdminController", [
            'End adminValidate'
        ]);
        return redirect('adminLogin');
    }
}
