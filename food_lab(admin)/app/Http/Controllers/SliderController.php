<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderValidation;
use App\Models\M_Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Common\Variable;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::channel('adminlog')->info("SliderController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("SliderController", [
            'End create'
        ]);
        return view('admin.setting.appManage.sliderAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commonVar = new Variable();
        Log::channel('adminlog')->info("SliderController", [
            'Start store'
        ]);
        $request->validate([
            'title' => 'required|min:0|max:30',
            'detail' => 'required|min:0|max:50',
            'buttonStatus' => 'required|integer|min:0|max:30',
            'buttonText' => 'min:0|max:20',
            'buttonLink' => 'max:50',
            'sliderImage' => 'required'
        ]);
        if ($request->hasFile('sliderImage')) {
            $file = $request->file('sliderImage');
            $file->storeAs('sliderImageFile', $file->getClientOriginalName());
            $logo = $request->file('sliderImage');
            $sliderImage = $commonVar->STORAGE_PREFIX .'sliderImageFile/'
            .$logo->getClientOriginalName();
            $admin = new M_Slider();
            $admin->sliderAdd($request, $sliderImage);
        }
        Log::channel('adminlog')->info("SliderController", [
            'End store'
        ]);
        return redirect('app');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::channel('adminlog')->info("SliderController", [
            'Start show'
        ]);
        $admin = new M_Slider();
        $admins =  $admin->sliderEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SliderController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {

            Log::channel('adminlog')->info("SliderController", [
                'End show'
            ]);
            return view('admin.setting.appManage.sliderEdit', ['slider' => $admins]);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::channel('adminlog')->info("SliderController", [
            'Start update'
        ]);
        $request->validate([
            'title' => 'required|min:0|max:30',
            'detail' => 'required|min:0|max:50',
            'buttonStatus' => 'required|integer|min:0|max:30',
            'buttonText' => 'min:0|max:20',
            'buttonLink' => 'max:50'
        ]);

        $admin = new M_Slider();
        $admins =  $admin->sliderEditView($id);
        $sliderImage = $admin->findOldImage($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SliderController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            if ($request->hasFile('sliderImage')) {
                $file = $request->file('sliderImage');
                $file->storeAs('sliderImageFile', $file->getClientOriginalName());
                $logo = $request->file('sliderImage');
                $sliderImage = $logo->getClientOriginalName();
                $admin = new M_Slider();
                $admin->sliderEdit($request, $id, $sliderImage);
            } else {
                $admin = new M_Slider();
                $admin->sliderEdit($request, $id, $sliderImage);
            }
            Log::channel('adminlog')->info("SliderController", [
                'End update'
            ]);
            return redirect('app');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::channel('adminlog')->info("SliderController", [
            'Start destroy'
        ]);
        $admin = new M_Slider();
        $admins =  $admin->sliderEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("SliderController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_Slider();
            $admin->sliderDelete($id);
            Log::channel('adminlog')->info("SliderController", [
                'End destroy'
            ]);
            return redirect('app');
        }
    }
}
