<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_AD_News;
use App\Models\M_Site;
use App\Models\NewsModel;
use App\Models\SiteManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Common\Variable;

class NewsController extends Controller
{
    /* admin
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show news add view.
    */

    public function index()
    {
        Log::channel('adminlog')->info("NewsController", [
            'Start index'
        ]);
        $app = new M_Site();
        $admins = $app->news();
        Log::channel('adminlog')->info("NewsController", [
            'End index'
        ]);
        return view('admin.setting.newsManage.newsManage', ['news' => $admins]);
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show news add view.
    */

    public function create()
    {
        Log::channel('adminlog')->info("NewsController", [
            'Start create'
        ]);
        $app = new M_AD_News();
        $admins = $app->newsAddView();
        Log::channel('adminlog')->info("NewsController", [
            'End create'
        ]);
        return view('admin.setting.newsManage.newsAdd', ['categories' => $admins]);
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store news.
    */

    public function store(Request $request)
    {
        $commonVar = new Variable();
        Log::channel('adminlog')->info("NewsController", [
            'Start create'
        ]);
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'detail' => 'required'
        ]);

        if ($request->hasFile('source')) {
            $file = $request->file('source');
            $file->storeAs('newsImage', $file->getClientOriginalName());
        } else {
            echo "File Not Received";
        }
        $logo = $request->file('source');
        $siteLogo =$commonVar->STORAGE_PREFIX . 'newsImage/'
        .$logo->getClientOriginalName();
        $admin = new M_AD_News();
        $admin->newsAdd($request, $siteLogo);
        Log::channel('adminlog')->info("NewsController", [
            'End create'
        ]);
        return redirect('news');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show news  edit view.
    */

    public function show($newsid)
    {
        Log::channel('adminlog')->info("NewsController", [
            'Start show'
        ]);
        $admin = new M_AD_News();
        $news = $admin->newsEditView($newsid);
        Log::channel('adminlog')->info("news", [
            $news
        ]);
        if ($news === null) {
            Log::channel('adminlog')->info("FavtypeController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            $site = new M_Site();
            $categories =  $site->categories();
            Log::channel('adminlog')->info("NewsController", [
                'End show'
            ]);
            return view('admin.setting.newsManage.newsEdit', ['news' => $news, 'categories' => $categories]);
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update news.
    */

    public function update(Request $request, $id)
    {
        Log::channel('adminlog')->info("NewsController", [
            'Start update'
        ]);
        $admin = new M_AD_News();
        $news = $admin->newsEditView($id);
        if ($news === null) {
            Log::channel('adminlog')->info("FavtypeController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            $request->validate([
                'title' => 'required',
                'category' => 'required',
                'detail' => 'required'
            ]);
            $admin = new M_AD_News();
            $admin->newsEdit($request, $id);
            Log::channel('adminlog')->info("NewsController", [
                'End update'
            ]);
            return redirect('news');
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update del_flg to 1.
    */
    public function destroy($id)
    {
        $admin = new M_AD_News();
        $news = $admin->newsEditView($id);
        if ($news === null) {
            Log::channel('adminlog')->info("FavtypeController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("NewsController", [
                'Start destroy'
            ]);
            $admin = new M_AD_News();
            $admin->newsDelete($id);
            Log::channel('adminlog')->info("NewsController", [
                'End destroy'
            ]);
            return redirect('news');
        }
    }
}
