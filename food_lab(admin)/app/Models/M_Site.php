<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Site extends Model
{
    public $table = 'm_site';
    use HasFactory;

    /*
     * Create : Min Khant(23/1/2022)
     * Update :
     * Explain of function : check server maintenance
     * Prarameter : no
     * return : maintenance true/false
     * */
    public function maintenance()
    {
        Log::channel('customerlog')->info('M_Site Model', [
            'start maintenance'
        ]);

        $maintenance = M_Site::select('maintenance')->first();

        Log::channel('customerlog')->info('M_Site Model', [
            'start maintenance'
        ]);

        return $maintenance;
    }

    /*
    * Create:zayar(2022/01/13)
    * Update:
    * This function is used to show site and app management view. (admin)
    */
    public function siteManage()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start siteManage'
        ]);
        $siteinfo = M_Site::where('del_flg', '=', 0)->orderBy('id', 'desc')->first();
        if ($siteinfo === null) {
            Log::channel('adminlog')->info("M_Site Model", [
                'End siteManage(error)'
            ]);
            return null;
        } else {
            Log::channel('adminlog')->info("M_Site Model", [
                'End siteManage'
            ]);
            return $siteinfo;
        }
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get township datas. (admin)
   */
    public function township()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start township'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End township'
        ]);
        return M_Township::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get payments datas.
   */
    public function payments()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start payments'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End payments'
        ]);
        return M_Payment::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get categories datas. (admin)
   */
    public function categories()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start categories'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End categories'
        ]);
        return M_News_Category::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get tastes datas. (admin)
   */
    public function tastes()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start tastes'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End tastes'
        ]);
        return M_Taste::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get suggests datas. (admin)
   */
    public function suggests()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start suggests'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End suggests'
        ]);
        return M_Suggest::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get favtypes datas. (admin)
   */
    public function favtypes()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start favtypes'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End favtypes'
        ]);
        return M_Fav_Type::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get orderStatus datas. (admin)
   */
    public function orderStatus()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start orderStatus'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End orderStatus'
        ]);
        return M_Order_Status::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get desicions datas. (admin)
   */
    public function desicions()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start desicions'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End desicions'
        ]);
        return M_Decison_Status::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get news datas. (admin)
   */
    public function news()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start news'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End news'
        ]);
        return M_AD_News::select('*', DB::raw('m_ad_news.id AS newsid'))
            ->orderBy('m_ad_news.updated_at', 'DESC')
            ->where('m_ad_news.del_flg', 0)
            ->join('m_news_category', 'm_news_category.id', '=', 'm_ad_news.category')
            ->paginate(3);
    }

    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to update site datas. (admin)
   */
    public function saveSiteUpdate($request, $siteLogo)
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start saveSiteUpdate'
        ]);
        $siteFirst = M_Site::where('del_flg', '=', 0)->first();
        if ($siteFirst === null) {
            $site = new M_Site();
            $site->site_name = $request->input('name');
            $site->site_logo = $siteLogo;
            $site->privacy_policy = $request->input('policy');
            $site->maintenance = $request->input('maintenance');
            $site->intro = $request->input('intro');
            $site->address = $request->input('address');
            $site->phone1 = $request->input('phone1');
            $site->phone2 = $request->input('phone2');
            $site->phone3 = $request->input('phone3');
            $site->gmail = $request->input('gmail');
            $site->save();
        } else {
            $siteFirst->site_name = $request->input('name');
            $siteFirst->site_logo = $siteLogo;
            $siteFirst->privacy_policy = $request->input('policy');
            $siteFirst->maintenance = $request->input('maintenance');
            $siteFirst->intro = $request->input('intro');
            $siteFirst->address = $request->input('address');
            $siteFirst->phone1 = $request->input('phone1');
            $siteFirst->phone2 = $request->input('phone2');
            $siteFirst->phone3 = $request->input('phone3');
            $siteFirst->gmail = $request->input('gmail');
            $siteFirst->save();
        }
        Log::channel('adminlog')->info("M_Site Model", [
            'End saveSiteUpdate'
        ]);
    }
}
