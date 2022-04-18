<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_Site;
use Illuminate\Http\Request;

class AppController extends Controller
{
    // (admin)
    public function index()
    {
        $admin = new M_Site();
        $townships =  $admin->township();
        $payments =  $admin->payments();
        $categories =  $admin->categories();
        $tastes =  $admin->tastes();
        $suggests =  $admin->suggests();
        $favtypes =  $admin->favtypes();
        $orderStatus =  $admin->orderStatus();
        $desicions =  $admin->desicions();
        $slider = $admin->sliders();
        return view(
            'admin.setting.appManage.appManage',
            [
                'townships' => $townships,
                'payments' => $payments,
                'categories' => $categories,
                'tastes' => $tastes,
                'suggests' => $suggests,
                'favtypes' => $favtypes,
                'orderstatus' => $orderStatus,
                'decisions' => $desicions,
                'sliders' => $slider
            ]
        );
    }
}
