<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CategoryModel extends Model
{
    public $table = 'm_news_category';
    use HasFactory;

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store category.
    */

    public function categoryAdd($validate)
    {
        Log::channel('adminlog')->info("CategoryModel Model", [
            'Start categoryAdd'
        ]);
        $admin = new CategoryModel();
        $admin->category_name = $validate['category_name'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("CategoryModel Model", [
            'End categoryAdd'
        ]);
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show category edit view.
    */

    public function categoryEditView($id)
    {
        Log::channel('adminlog')->info("CategoryModel Model", [
            'Start categoryEditView'
        ]);
        return CategoryModel::find($id);
        Log::channel('adminlog')->info("CategoryModel Model", [
            'End categoryEditView'
        ]);
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update category.
    */

    public function categoryEdit($validate, $id)
    {
        Log::channel('adminlog')->info("CategoryModel Model", [
            'Start categoryEdit'
        ]);
        $admin = CategoryModel::find($id);
        $admin->category_name = $validate['category_name'];
        $admin->note = $validate['note'];
        $admin->save();
        Log::channel('adminlog')->info("CategoryModel Model", [
            'End categoryEdit'
        ]);
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update del_flg to 1.
    */
    public function categoryDelete($id)
    {
        Log::channel('adminlog')->info("CategoryModel Model", [
            'Start categoryDelete'
        ]);
        $admin = CategoryModel::find($id);
        $admin->del_flg = 1;
        $admin->save();
        Log::channel('adminlog')->info("CategoryModel Model", [
            'End categoryDelete'
        ]);
    }
}
