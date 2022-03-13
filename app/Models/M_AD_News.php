<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class M_AD_News extends Model
{
    public $table = 'm_ad_news';
    use HasFactory;
    /*
    * Create:zayar(2022/01/15)
    * Update:
    * This function is used to show news add view. (admin)
    */

    public function newsAddView()
    {
        Log::channel('adminlog')->info("M_AD_News Model", [
            'Start newsAddView'
        ]);
        Log::channel('adminlog')->info("M_AD_News Model", [
            'End newsAddView'
        ]);
        return M_News_Category::where('del_flg', '=', 0)->get();
    }
    /*
   * Create:zayar(2022/01/15)
   * Update:
   * This function is used to store news. (admin)
   */

    public function newsAdd($request, $siteLogo)
    {
        Log::channel('adminlog')->info("M_AD_News Model", [
            'Start newsAdd'
        ]);
        $admin = new M_AD_News();
        $admin->title = $request->input('title');
        $admin->source = $siteLogo;
        $admin->detail = $request->input('detail');
        $admin->category = $request->input('category');
        $admin->write_by = 1; //need to change
        $admin->save();
        Log::channel('adminlog')->info("M_AD_News Model", [
            'End newsAdd'
        ]);
    }
    /*
   * Create:zayar(2022/01/15)
   * Update:
   * This function is used to show news edit view. (admin)
   */

    public function newsEditView($newsid)
    {
        Log::channel('adminlog')->info("M_AD_News Model", [
            'Start newsEditView'
        ]);
        Log::channel('adminlog')->info("M_AD_News Model", [
            'End newsEditView'
        ]);
        return  M_AD_News::select('*', DB::raw('m_ad_news.id AS newsid'))
            ->where('m_ad_news.id', $newsid)
            ->where('m_ad_news.del_flg', 0)
            ->join('m_news_category', 'm_news_category.id', '=', 'm_ad_news.category')
            ->first();
    }

    /*
   * Create:zayar(2022/01/15)
   * Update:
   * This function is used to update news. (admin)
   */

    public function newsEdit($request, $id)
    {
        Log::channel('adminlog')->info("M_AD_News Model", [
            'Start newsEdit'
        ]);
        $admin = M_AD_News::find($id);
        $admin->title = $request->input('title');
        $admin->detail = $request->input('detail');
        $admin->category = $request->input('category');
        $admin->write_by = 1; //need to change
        $admin->save();
        Log::channel('adminlog')->info("M_AD_News Model", [
            'End newsEdit'
        ]);
    }
    /*
   * Create:zayar(2022/01/15)
   * Update:
   * This function is used to update del_flg to 1. (admin)
   */
    public function newsDelete($id)
    {
        Log::channel('adminlog')->info("M_AD_News Model", [
            'Start newsDelete'
        ]);
        $admin = M_AD_News::find($id);
        $admin->del_flg = 1;
        $admin->save();
        Log::channel('adminlog')->info("M_AD_News Model", [
            'End newsDelete'
        ]);
    }

    use HasFactory;
}
