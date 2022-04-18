<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Slider extends Model
{
    use HasFactory;
    public $table = 'm_slider';
    public function sliderAdd($request, $sliderImage)
    {
        Log::channel('adminlog')->info("M_Slider Model", [
            'Start sliderAdd'
        ]);
        $admin = new M_Slider();
        $admin->banner_title = $request->input('title');
        $admin->banner_detail = $request->input('detail');
        $admin->button_state = $request->input('buttonStatus');
        $admin->button_text  = $request->input('buttonText');
        $admin->button_link = $request->input('buttonLink');
        $admin->image = $sliderImage;
        $admin->save();
        Log::channel('adminlog')->info("M_Slider Model", [
            'End sliderAdd'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to show taste edit view. (admin)
   */

    public function sliderEditView($id)
    {
        Log::channel('adminlog')->info("M_Slider Model", [
            'Start sliderEditView'
        ]);
        Log::channel('adminlog')->info("M_Slider Model", [
            'End sliderEditView'
        ]);
        return M_Slider::find($id);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update taste. (admin)
   */

    public function sliderEdit($request, $id, $sliderImage)
    {
        Log::channel('adminlog')->info("M_Slider Model", [
            'Start sliderEdit'
        ]);
        $admin = M_Slider::find($id);
        $admin->banner_title = $request->input('title');
        $admin->banner_detail = $request->input('detail');
        $admin->button_state = $request->input('buttonStatus');
        $admin->button_text  = $request->input('buttonText');
        $admin->button_link = $request->input('buttonLink');
        $admin->image = $sliderImage;
        $admin->save();
        Log::channel('adminlog')->info("M_Slider Model", [
            'End sliderEdit'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update del_flg to 1. (admin)
   */
    public function sliderDelete($id)
    {
        Log::channel('adminlog')->info("M_Slider Model", [
            'Start tasteDelete'
        ]);
        $admin = M_Slider::find($id);
        $admin->del_flg = 1;
        $admin->save();
        Log::channel('adminlog')->info("M_Slider Model", [
            'End tasteDelete'
        ]);
    }
    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to update del_flg to 1. (admin)
   */
    public function findOldImage($id)
    {
        Log::channel('adminlog')->info("M_Slider Model", [
            'Start findOldImage'
        ]);
        $admin = M_Slider::find($id);
        return $admin->image;
        Log::channel('adminlog')->info("M_Slider Model", [
            'End findOldImage'
        ]);
    }
}
