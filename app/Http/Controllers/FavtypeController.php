<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavouriteValidation;
use App\Models\FavTypeModel;
use App\Models\M_AD_Track;
use App\Models\M_Fav_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FavtypeController extends Controller
{
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show Favourite Type add view.(admin)
    */

    public function create()
    {
        Log::channel('adminlog')->info("FavtypeController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("FavtypeController", [
            'End create'
        ]);
        return view('admin.setting.appManage.favTypeAdd');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store Favourite Type.(admin)
    */

    public function store(FavouriteValidation $request)
    {
        Log::channel('adminlog')->info("FavtypeController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_Fav_Type();
        $admin->favTypeAdd($validate);
        Log::channel('adminlog')->info("FavtypeController", [
            'End store'
        ]);
        return redirect('app');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show Favourite Type edit view.(admin)
    */

    public function show($id)
    {
        Log::channel('adminlog')->info("FavtypeController", [
            'Start show'
        ]);
        $admin = new M_Fav_Type();
        $admins = $admin->favTypeEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("FavtypeController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("FavtypeController", [
                'End show'
            ]);
            return view('admin.setting.appManage.favTypeEdit', ['fav' => $admins]);
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update Favourite Type.(admin)
    */

    public function update(FavouriteValidation $request, $id)
    {
        Log::channel('adminlog')->info("FavtypeController", [
            'Start update'
        ]);
        $admin = new M_Fav_Type();
        $admins = $admin->favTypeEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("FavtypeController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            $validate = $request->validated();
            $admin = new M_Fav_Type();
            $admin->favTypeEdit($validate, $id);
            Log::channel('adminlog')->info("FavtypeController", [
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

        Log::channel('adminlog')->info("FavtypeController", [
            'Start destroy'
        ]);
        $admin = new M_Fav_Type();
        $admins = $admin->favTypeEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("FavtypeController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_Fav_Type();
            $admin->favTypeDelete($id);
            Log::channel('adminlog')->info("FavtypeController", [
                'End destroy'
            ]);
            return redirect('app');
        }
    }
}
