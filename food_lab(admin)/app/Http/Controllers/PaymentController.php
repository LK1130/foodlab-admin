<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentValidation;
use App\Models\M_Payment;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // admin 
    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show payment add view.
    */

    public function create()
    {
        Log::channel('adminlog')->info("PaymentController", [
            'Start create'
        ]);
        Log::channel('adminlog')->info("PaymentController", [
            'End create'
        ]);
        return view('admin.setting.appManage.paymentAdd');
    }

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to store payment.
    */

    public function store(PaymentValidation $request)
    {
        Log::channel('adminlog')->info("PaymentController", [
            'Start store'
        ]);
        $validate = $request->validated();
        $admin = new M_Payment();
        $admin->paymentAdd($validate);
        Log::channel('adminlog')->info("PaymentController", [
            'End store'
        ]);
        return redirect('app');
    }

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to show payment edit view.
    */

    public function show($id)
    {
        Log::channel('adminlog')->info("PaymentController", [
            'Start show'
        ]);
        $admin = new M_Payment();
        $admins =  $admin->paymentEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("PaymentController", [
                'End show(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('adminlog')->info("PaymentController", [
                'End show'
            ]);
            return view('admin.setting.appManage.paymentEdit', ['payment' => $admins]);
        }
    }

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update payment.
    */

    public function update(PaymentValidation $request, $id)
    {
        Log::channel('adminlog')->info("PaymentController", [
            'Start update'
        ]);
        $admin = new M_Payment();
        $admins =  $admin->paymentEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("PaymentController", [
                'End update(error)'
            ]);
            return view('errors.404');
        } else {
            $validate = $request->validated();
            $admin = new M_Payment();
            $admin->paymentEdit($validate, $id);
            Log::channel('adminlog')->info("PaymentController", [
                'End update'
            ]);
            return redirect('app');
        }
    }

    /*
    * Create:zayar(2022/01/15) 
    * Update: 
    * This function is used to update del_flg to 1.
    */
    public function destroy($id)
    {
        Log::channel('adminlog')->info("PaymentController", [
            'Start destroy'
        ]);
        $admin = new M_Payment();
        $admins =  $admin->paymentEditView($id);
        if ($admins === null) {
            Log::channel('adminlog')->info("PaymentController", [
                'End destroy(error)'
            ]);
            return view('errors.404');
        } else {
            $admin = new M_Payment();
            $admin->paymentDelete($id);
            Log::channel('adminlog')->info("PaymentController", [
                'End destroy'
            ]);
            return redirect('app');
        }
    }
}
