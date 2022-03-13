<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TasteValidation;
use App\Models\M_Taste;
use App\Models\TasteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TasteController extends Controller
{
    /* admin
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show taste add view.
    */

    public function create()
    {
        Log::channel('adminlog')->info("TasteController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("TasteController", [
            'End create'
        ]);
        return view('admin.setting.appManage.tasteAdd');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store taste.
    */

    public function store(TasteValidation $request)
    {
        Log::channel('adminlog')->info("TasteController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_Taste();
        $admin->tasteAdd($validate);
        Log::channel('adminlog')->info("TasteController", [
            'End store'
        ]);
        return redirect('app');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show taste edit view.
    */

    public function show($id)
    {
        Log::channel('adminlog')->info("TasteController", [
            'Start show'
        ]);
        $admin = new M_Taste();
        $admins = $admin->tasteEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SuggestController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("SuggestController", [
                'End show'
            ]);
            return view('admin.setting.appManage.tasteEdit', ['taste' => $admins]);
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update taste.
    */

    public function update(TasteValidation $request, $id)
    {
        Log::channel('adminlog')->info("TasteController", [
            'Start update'
        ]);
        $admin = new M_Taste();
        $admins = $admin->tasteEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SuggestController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("SuggestController", [
                'End update'
            ]);
            $validate = $request->validated();
            $admin = new M_Taste();
            $admin->tasteEdit($validate, $id);
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
        Log::channel('adminlog')->info("TasteController", [
            'Start destroy'
        ]);
        $admin = new M_Taste();
        $admins = $admin->tasteEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SuggestController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("SuggestController", [
                'End destroy'
            ]);
            $admin = new M_Taste();
            $admin->tasteDelete($id);
            return redirect('app');
        }
    }
}
