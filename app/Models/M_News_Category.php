<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_News_Category extends Model
{
    public $table = 'm_news_category';
    use HasFactory;
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store category. (admin)
    */

    public function categoryAdd($validate)
    {
        Log::channel('adminlog')->info("M_News_Category Model", [
            'Start categoryAdd'
        ]);
        $admin = new M_News_Category();
        $admin->category_name = $validate['category_name'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("M_News_Category Model", [
            'End categoryAdd'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to show category edit view. (admin)
   */

    public function categoryEditView($id)
    {
        Log::channel('adminlog')->info("M_News_Category Model", [
            'Start categoryEditView'
        ]);
        Log::channel('adminlog')->info("M_News_Category Model", [
            'End categoryEditView'
        ]);
        return M_News_Category::find($id);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update category. (admin)
   */

    public function categoryEdit($validate, $id)
    {
        Log::channel('adminlog')->info("M_News_Category Model", [
            'Start categoryEdit'
        ]);
        $admin = M_News_Category::find($id);
        $admin->category_name = $validate['category_name'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("M_News_Category Model", [
            'End categoryEdit'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update del_flg to 1. (admin)
   */
    public function categoryDelete($id)
    {
        Log::channel('adminlog')->info("M_News_Category Model", [
            'Start categoryDelete'
        ]);
        $admin = M_News_Category::find($id);
        $admin->del_flg = 1;
        $admin->save();
        Log::channel('adminlog')->info("M_News_Category Model", [
            'End categoryDelete'
        ]);
    }
}
