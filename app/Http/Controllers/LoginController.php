<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditValidation;
use App\Http\Requests\adminValidation;
use App\Models\AdminLogin;
use App\Models\M_AD_Login;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*admin
    * Create:zayar(2022/01/12) 
    * Update: 
    * This is function is to show admin list view.
    * Return is view (adminList.blade.php)
    */
    public function index()
    {
        Log::channel('adminlog')->info("LoginController", [
            'Start index'
        ]);
        $admin = new M_AD_Login();
        $admins = $admin->AdminList();
        Log::channel('adminlog')->info("LoginController", [
            'End index'
        ]);
        return view('admin.setting.loginManage.adminList', ['admins' => $admins]);
    }


    /*
    * Create:zayar(2022/01/12) 
    * Update: 
    * This is function is to show admin adding view.
    * Return is view (adminList.blade.php)
    */
    public function create()
    {
        Log::channel('adminlog')->info("LoginController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("LoginController", [
            'End create'
        ]);
        return view('admin.setting.loginManage.adminAdd');
    }

    /*
    * Create:zayar(2022/01/10) 
    * Update: 
    * This is function is to store data by passing parameter to model
    * $request is used for form data
    * Return is view (adminList.blade.php)
    */
    public function store(AdminValidation $request)
    {
        Log::channel('adminlog')->info("LoginController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_AD_Login();
        $admin->AdminAdd($validate);
        Log::channel('adminlog')->info("LoginController", [
            'End store'
        ]);
        return redirect('adminLogin');
    }


    /*
    * Create:zayar(2022/01/10) 
    * Update: 
    * This is function is to show specified resource.
    * $id is used searching this userid
    * Return is view (adminList.blade.php)
    */
    public function show($id)
    {
        Log::channel('adminlog')->info("LoginController", [
            'Start show'
        ]);
        $model = new M_AD_Login();
        $find = $model->AdminDetail($id);
        if ($find === null) {
            Log::channel('adminlog')->info("LoginController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_AD_Login();
            $admins = $admin->AdminDetail($id);
            Log::channel('adminlog')->info("LoginController", [
                'End show'
            ]);
            return view('admin.setting.loginManage.adminDetail', ['admins' => $admins]);
        }
    }
    /*
    * Create:zayar(2022/01/10) 
    * Update: 
    * This is function is to show specified resource in Admin Edit View..
    * $id is used searching this adminid.
    * Return is view (adminList.blade.php)
    */
    public function edit($id)
    {
        Log::channel('adminlog')->info("LoginController", [
            'Start edit'
        ]);
        $model = new M_AD_Login();
        $find = $model->AdminDetail($id);
        $oldname = $find["ad_name"];

        session(['oldname' => $oldname]);
        $model = new M_AD_Login();
        $find = $model->AdminDetail($id);
        if ($find === null) {
            Log::channel('adminlog')->info("LoginController", [
                'End edit(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_AD_Login();
            $admins = $admin->AdminEdit($id);
            Log::channel('adminlog')->info("LoginController", [
                'End edit'
            ]);
            return view('admin.setting.loginManage.adminEdit', ['admins' => $admins]);
        }
    }

    /*
    * Create:zayar(2022/01/10) 
    * Update: 
    * This is function is to update specified user request.
    * $id is used searching this adminid.
    * Return is view (adminList.blade.php)
    */
    public function update(AdminEditValidation $request, $id)
    {
        Log::channel('adminlog')->info("LoginController", [
            'Start update'
        ]);

        $model = new M_AD_Login();
        $find = $model->AdminDetail($id);


        if ($find === null) {
            Log::channel('adminlog')->info("LoginController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            $validate = $request->validated();
            $admin = new M_AD_Login();
            $admin->AdminUpdate($validate, $id);
            Log::channel('adminlog')->info("LoginController", [
                'End update'
            ]);
            session()->forget('oldname');
            return redirect('adminLogin');
        }
    }

    /*
    * Create:zayar(2022/01/12) 
    * Update: 
    * This is function is to delete specified user request.
    * $id is used searching this adminid.
    * Return is view (adminList.blade.php)
    */
    public  function destroy($id)
    {

        Log::channel('adminlog')->info("LoginController", [
            'Start destroy'
        ]);
        $model = new M_AD_Login();
        $find = $model->AdminDetail($id);
        if ($find === null) {
            Log::channel('adminlog')->info("LoginController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_AD_Login();
            $admin->AdminDelete($id);
            Log::channel('adminlog')->info("LoginController", [
                'End destroy'
            ]);
            return redirect('adminLogin');
        }
    }
}
