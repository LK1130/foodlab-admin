<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TownshipValidation;
use App\Models\M_Township;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TownshipController extends Controller
{
    /*admin
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show township add view.
    */
    public function create()
    {
        Log::channel('adminlog')->info("TownshipController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("TownshipController", [
            'End create'
        ]);
        return view('admin.setting.appManage.townshipAdd');
    }

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store township.
    */
    public function store(TownshipValidation $request)
    {
        Log::channel('adminlog')->info("TownshipController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_Township();
        $admin->townshipAdd($validate);
        Log::channel('adminlog')->info("TownshipController", [
            'End store'
        ]);
        return redirect('app');
    }

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show township edit view.
    */
    public function show($id)
    {
        Log::channel('adminlog')->info("TownshipController", [
            'Start show'
        ]);
        $admin = new M_Township();
        $admins = $admin->townshipEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("TownshipController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("TownshipController", [
                'End show'
            ]);
            return view('admin.setting.appManage.townshipEdit', ['township' => $admins]);
        }
    }

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update township.
    */
    public function update(TownshipValidation $request, $id)
    {
        Log::channel('adminlog')->info("TownshipController", [
            'Start update'
        ]);
        $admin = new M_Township();
        $admins = $admin->townshipEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("TownshipController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("TownshipController", [
                'End update'
            ]);
            $validate = $request->validated();
            $admin = new M_Township();
            $admin->townshipEdit($validate, $id);
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
        Log::channel('adminlog')->info("TownshipController", [
            'Start destroy'
        ]);
        $admin = new M_Township();
        $admins = $admin->townshipEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("TownshipController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("TownshipController", [
                'End destroy'
            ]);
            $admin = new M_Township();
            $admin->townshipDelete($id);
            return redirect('app');
        }
    }
}
