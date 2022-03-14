<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuggestValidation;
use App\Models\M_Suggest;
use App\Models\SuggestModel;
use App\Models\T_AD_Suggest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuggestController extends Controller
{
    // admin 
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show suggest add view.
    */

    public function create()
    {
        Log::channel('adminlog')->info("SuggestController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("SuggestController", [
            'End create'
        ]);
        return view('admin.setting.appManage.suggestAdd');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store suggest.
    */

    public function store(SuggestValidation $request)
    {
        Log::channel('adminlog')->info("SuggestController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_Suggest();
        $admin->suggestAdd($validate);
        Log::channel('adminlog')->info("SuggestController", [
            'End store'
        ]);
        return redirect('app');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show suggest edit view.
    */

    public function show($id)
    {
        Log::channel('adminlog')->info("SuggestController", [
            'Start show'
        ]);
        $admin = new M_Suggest();
        $admins = $admin->suggestEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SuggestController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("SuggestController", [
                'End show'
            ]);
            return view('admin.setting.appManage.suggestEdit', ['suggest' => $admins]);
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update suggest.
    */

    public function update(SuggestValidation $request, $id)
    {
        Log::channel('adminlog')->info("SuggestController", [
            'Start update'
        ]);
        $admin = new M_Suggest();
        $admins = $admin->suggestEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SuggestController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            $validate = $request->validated();
            $admin = new M_Suggest();
            $admin->suggestEdit($validate, $id);
            Log::channel('adminlog')->info("SuggestController", [
                'End update'
            ]);
            return redirect('app');
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update del_flg to 1.
    */
    public function destroy($id)
    {
        Log::channel('adminlog')->info("SuggestController", [
            'Start destroy'
        ]);
        $admin = new M_Suggest();
        $admins = $admin->suggestEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SuggestController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_Suggest();
            $admin->suggestDelete($id);
            Log::channel('adminlog')->info("SuggestController", [
                'End destroy'
            ]);
            return redirect('app');
        }
    }
}
