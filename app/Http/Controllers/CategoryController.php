<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryValidation;
use App\Models\CategoryModel;
use App\Models\M_News_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show category add view.(admin)
    */

    public function create()
    {
        Log::channel('adminlog')->info("CategoryController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("CategoryController", [
            'End create'
        ]);
        return view('admin.setting.appManage.categoryAdd');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store category.(admin)
    */

    public function store(CategoryValidation $request)
    {
        Log::channel('adminlog')->info("CategoryController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_News_Category();
        $admin->categoryAdd($validate);
        Log::channel('adminlog')->info("CategoryController", [
            'End create'
        ]);
        return redirect('app');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show category edit view.(admin)
    */

    public function show($id)
    {
        Log::channel('adminlog')->info("CategoryController", [
            'Start show'
        ]);
        $admin = new M_News_Category();
        $admins = $admin->categoryEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("CategoryController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("CategoryController", [
                'End show'
            ]);
            return view('admin.setting.appManage.categoryEdit', ['category' => $admins]);
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update category.(admin)
    */

    public function update(CategoryValidation $request, $id)
    {
        Log::channel('adminlog')->info("CategoryController", [
            'Start Update'
        ]);
        $admin = new M_News_Category();
        $admins = $admin->categoryEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("CategoryController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            $validate = $request->validated();
            $admin = new M_News_Category();
            $admin->categoryEdit($validate, $id);
            Log::channel('adminlog')->info("CategoryController", [
                'End Update'
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
        Log::channel('adminlog')->info("CategoryController", [
            'Start Destory'
        ]);
        $admin = new M_News_Category();
        $admins = $admin->categoryEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("CategoryController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_News_Category();
            $admin->categoryDelete($id);

            Log::channel('adminlog')->info("CategoryController", [
                'End destroy'
            ]);
            return redirect('app');
        }
    }
}
