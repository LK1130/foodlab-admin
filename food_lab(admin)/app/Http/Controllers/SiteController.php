<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_Site;
use App\Models\siteManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Common\Variable;

class SiteController extends Controller
{
    // admin 
    public function siteManage()
    {
        Log::channel('adminlog')->info("SiteController", [
            'Start siteManage'
        ]);
        $admin = new M_Site();
        $siteInfo =  $admin->siteManage();
        Log::channel('adminlog')->info("SiteController", [
            'End siteManage'
        ]);
        return view('admin.setting.siteManage.siteManage', [
            'siteInfo' => $siteInfo
        ]);
    }

    // admin 
    public function store(Request $request)
    {
        $commonVar = new Variable();
        Log::channel('adminlog')->info("SiteController", [
            'Start store'
        ]);
        $request->validate([
            'name' => 'required|min:0|max:15',
            'policy' => 'required|min:10|max:255',
            'maintenance' => 'required|numeric|min:0|max:1',
            'intro' => 'required|min:0|max:255',
            'address' => 'required|min:0|max:255',
            'phone1' => 'required|min:0|max:15',
            'phone2' => 'nullable',
            'phone3' => 'nullable',
            'gmail' => 'required|min:0|max:100'
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file->storePubliclyAs('siteLogo', $file->getClientOriginalName());
            $logo = $request->file('logo');
            $siteLogo = $commonVar->STORAGE_PREFIX . 'siteLogo/'
            .$logo->getClientOriginalName();
            $admin = new M_Site();
            $admin->saveSiteUpdate($request, $siteLogo);
        } else {
            $logo = $request->input('oldSiteLogo');
            $admin = new M_Site();
            $admin->saveSiteUpdate($request, $logo);
        }

        Log::channel('adminlog')->info("SiteController", [
            'End store'
        ]);
        return redirect('siteManage');
    }
}
