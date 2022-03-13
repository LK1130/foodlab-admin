<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderValidation;
use App\Models\M_Order_Status;
use App\Models\OrderStatusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderStatusController extends Controller
{
    /*admin
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show Order Status add view.
    */

    public function create()
    {
        Log::channel('adminlog')->info("OrderStatusController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("OrderStatusController", [
            'End create'
        ]);
        return view('admin.setting.appManage.orderStatusAdd');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store Order Status.
    */

    public function store(OrderValidation $request)
    {
        Log::channel('adminlog')->info("OrderStatusController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_Order_Status();
        $admin->orderStatusAdd($validate);
        Log::channel('adminlog')->info("OrderStatusController", [
            'End store'
        ]);
        return redirect('app');
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show Order Status edit view.
    */

    public function show($id)
    {
        Log::channel('adminlog')->info("OrderStatusController", [
            'Start show'
        ]);
        $admin = new M_Order_Status();
        $admins =  $admin->orderStatusEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("OrderStatusController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("OrderStatusController", [
                'End show'
            ]);
            return view('admin.setting.appManage.orderStatusEdit', ['orderstatus' => $admins]);
        }
    }
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update Order Status.
    */

    public function update(OrderValidation $request, $id)
    {
        Log::channel('adminlog')->info("OrderStatusController", [
            'Start update'
        ]);
        $admin = new M_Order_Status();
        $admins =  $admin->orderStatusEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("OrderStatusController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            $validate = $request->validated();
            $admin = new M_Order_Status();
            $admin->orderStatusEdit($validate, $id);
            Log::channel('adminlog')->info("OrderStatusController", [
                'End update'
            ]);
            return redirect('app');
        }
    }
}
