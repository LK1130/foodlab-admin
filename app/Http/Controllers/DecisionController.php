<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DecisionValidation;
use App\Models\DecisionStatusModel;
use App\Models\M_Decison_Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DecisionController extends Controller
{
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show Decision add view. (admin)
    */

    public function create()
    {
        Log::channel('adminlog')->info("DecisionController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("DecisionController", [
            'End create'
        ]);
        return view('admin.setting.appManage.decisionStatusAdd');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store Decision.(admin)
    */

    public function store(DecisionValidation $request)
    {
        Log::channel('adminlog')->info("DecisionController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_Decison_Status();
        $admin->decisionStatusAdd($validate);
        Log::channel('adminlog')->info("DecisionController", [
            'End store'
        ]);
        return redirect('app');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show Decision edit view.(admin)
    */

    public function show($id)
    {
        Log::channel('adminlog')->info("DecisionController", [
            'Start show'
        ]);
        $admin = new M_Decison_Status();
        $admins =  $admin->decisionStatusEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("DecisionController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_Decison_Status();
            $admins =  $admin->decisionStatusEditView($id);
            Log::channel('adminlog')->info("DecisionController", [
                'End show'
            ]);
            return view('admin.setting.appManage.decisionStatusEdit', ['decision' => $admins]);
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update Decision.(admin)
    */

    public function update(DecisionValidation $request, $id)
    {
        Log::channel('adminlog')->info("DecisionController", [
            'Start update'
        ]);
        $admin = new M_Decison_Status();
        $admins =  $admin->decisionStatusEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("DecisionController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            $validate = $request->validated();
            $admin = new M_Decison_Status();
            $admin->decisionStatusEdit($validate, $id);
            Log::channel('adminlog')->info("DecisionController", [
                'End update'
            ]);
            return redirect('app');
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update del_flg to 1.(admin)
    */
    public function destroy($id)
    {
        Log::channel('adminlog')->info("DecisionController", [
            'Start destroy'
        ]);
        $admin = new M_Decison_Status();
        $admins =  $admin->decisionStatusEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("DecisionController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_Decison_Status();
            $admin->decisionStatusDelete($id);
            Log::channel('adminlog')->info("DecisionController", [
                'End destroy'
            ]);
            return redirect('app');
        }
    }
}
