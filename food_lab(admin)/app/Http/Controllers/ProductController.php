<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_AD_CoinRate;
use App\Models\M_Fav_Type;
use App\Models\M_Product;
use App\Models\M_Product_Detail;
use App\Models\M_Taste;
use App\Models\T_AD_Evd;
use App\Models\T_AD_Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    * Create : Aung Min Khant(17/1/2022)
    * Update :
    * Explain of function : To get data from m_fav_type and m_taste database and view to add product form
    * return fav type data and taste data to product add view
    * */

    public function index()
    {
        Log::channel('adminlog')->info("ProductController", [
            'Start index'
        ]);

        $fav = new  M_Fav_Type();
        $mFav = $fav->getTypeAll();

        $taste = new M_Taste();
        $mTaste = $taste->getTasteAll();

        $mrate = new M_AD_CoinRate();
        $rates = $mrate->getRate();
        Log::channel('adminlog')->info("ProductController", [
            'End index'
        ]);

        return View('admin.product.productAdd', ['mFav' => $mFav, 'mTaste' => $mTaste, 'rates' => $rates, 'active' => 6]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /*
    * Create : Aung Min Khant(17/1/2022)
    * Update :
    * Explain of function : To insert data from request to product database
    * parament : all requestes from  product form
    * return : save data
    * */
    public function store(Request $request)
    {

        Log::channel('adminlog')->info("ProductController", [
            'Start Store'
        ]);

        $request->validate([
            'pname' => 'required',
            'coin' => 'required|min:0',
            'photo1' => 'required||max:51200',
            'photo2' => 'max:51200',
            'photo3' => 'max:51200',
            'photo4' => 'max:51200',
            'photo5' => 'max:51200',
            'photo6' => 'max:51200',
            'list' => 'required',
            'pdesc' => 'required'

        ]);
        DB::transaction(function () use ($request) {
            $labels = [];
            $categories = [];
            $valueOne = [];
            $valueTwo = [];
            $valueThree = [];
            $valueFour = [];
            $valueFive = [];
            $valueSix = [];
            $allValues = [];
            $images = [];


            $pdController = new ProductListController();
            $pdController->checkCategory($request);

            if ($request->hasFile('photo1')) {
                array_push($images, $request->file('photo1'));
            }
            if ($request->hasFile('photo2')) {
                array_push($images, $request->file('photo2'));
            }
            if ($request->hasFile('photo3')) {
                array_push($images, $request->file('photo3'));
            }
            if ($request->hasFile('photo4')) {
                array_push($images, $request->file('photo4'));
            }
            if ($request->hasFile('photo5')) {
                array_push($images, $request->file('photo5'));
            }
            if ($request->hasFile('photo6')) {
                array_push($images, $request->file('photo6'));
            }

            if ($request->has('pdname1') && $request->has('pdvalue1')) {
                array_push($labels, $request->input("pdname1"));
                $valueOne = explode(",", $request->input("pdvalue1"));
                array_push($allValues, $valueOne);
                array_push($categories, $request->input('category1'));
            }
            if ($request->has('pdname2') && $request->has('pdvalue2')) {
                array_push($labels, $request->input("pdname2"));
                $valueTwo = explode(",", $request->input("pdvalue2"));
                array_push($allValues, $valueTwo);
                array_push($categories, $request->input('category2'));
            }
            if ($request->has('pdname3') && $request->has('pdvalue3')) {
                array_push($labels, $request->input("pdname3"));
                $valueThree = explode(",", $request->input("pdvalue3"));
                array_push($allValues, $valueThree);
                array_push($categories, $request->input('category3'));
            }
            if ($request->has('pdname4') && $request->has('pdvalue4')) {
                array_push($labels, $request->input("pdname4"));
                $valueFour = explode(",", $request->input("pdvalue4"));
                array_push($allValues, $valueFour);
                array_push($categories, $request->input('category4'));
            }
            if ($request->has('pdname5') && $request->has('pdvalue5')) {
                array_push($labels, $request->input("pdname5"));
                $valueFive = explode(",", $request->input("pdvalue5"));
                array_push($allValues, $valueFive);
                array_push($categories, $request->input('category5'));
            }
            if ($request->has('pdname6') && $request->has('pdvalue6')) {
                array_push($labels, $request->input("pdname6"));
                $valueSix = explode(",", $request->input("pdvalue6"));
                array_push($allValues, $valueSix);
                array_push($categories, $request->input('category6'));
            }

            $product = new M_Product();
            $finalProduct = $product->saveData($request);

            $productDetail = new M_Product_Detail();
            $phd = new T_AD_Photo();


            for ($x = 0; $x < count($images); $x++) {

                $path = $images[$x]->storePublicly('ProductImage');
                $phd->insertImage($path, $finalProduct, $x + 1);
            }
            for ($i = 0; $i < count($labels); $i++) {
                $value = $allValues[$i];
                for ($j = 0; $j < count($value); $j++) {
                    $order = $j + 1;
                    $productDetail->insert($finalProduct, $categories[$i], $labels[$i], $order, $value[$j]);
                }
            }
        });


        Log::channel('adminlog')->info("ProductController", [
            'End Store'
        ]);

        return redirect('productList');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*
    * Create : Aung Min Khant(18/1/2022)
    * Update :
    * Explain of function : To edit data from request to product edit view
    * parament : all requestes from  product form
    * return : edit data
    * */
    public function edit($id)
    {

        Log::channel('adminlog')->info("ProductController", [
            'Start edit Data'
        ]);

        $taste = new M_Taste();
        $mTaste = $taste->getTasteAll();

        $type = new M_Fav_Type();
        $mFav = $type->getTypeAll();

        $mProduct = new M_Product();
        $product = $mProduct->getDataById($id);

        $mDetail = new M_Product_Detail();
        $mProductDetail = $mDetail->editData($id);

        $tPhd = new T_AD_Photo();
        $phd = $tPhd->editEvd($id);



        $mrate = new M_AD_CoinRate();
        $rates = $mrate->getRate();


        session(['1' => $tPhd->getPhoto(1, $product->id)]);
        session(['2' => $tPhd->getPhoto(2, $product->id)]);
        session(['3' => $tPhd->getPhoto(3, $product->id)]);
        session(['4' => $tPhd->getPhoto(4, $product->id)]);
        session(['5' => $tPhd->getPhoto(5, $product->id)]);
        session(['6' => $tPhd->getPhoto(6, $product->id)]);
        Log::channel('adminlog')->info("ProductController", [
            'End edit Data'
        ]);

        return View('admin.product.productEdit', ['mFav' => $mFav, 'mTaste' => $mTaste, 'products' => $product, "pdetails" => $mProductDetail, 'phd' => $phd, 'rates' => $rates]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :Aung Min Khant(21/1/2022)
    * Explain of function : To update data from request to database
    * parament : all requestes from  product form and specific id
    * return : update data
    * */
    public function update(Request $request, $id)
    {
        Log::channel('adminlog')->info("ProductController", [
            'Start Update Data'
        ]);


        $request->validate([
            'pname' => 'required',
            'coin' => 'required|min:0',

        ]);

        DB::transaction(function () use ($request, $id) {
            $labels = [];
            $categories = [];
            $valueOne = [];
            $valueTwo = [];
            $valueThree = [];
            $valueFour = [];
            $valueFive = [];
            $valueSix = [];
            $allValues = [];

            $pdController = new ProductListController();
            $pdController->checkCategory($request);


            if ($request->has('pdname1') && $request->has('pdvalue1')) {
                array_push($labels, $request->input("pdname1"));
                $valueOne = explode(",", $request->input("pdvalue1"));
                array_push($allValues, $valueOne);
                array_push($categories, $request->input('category1'));
            }
            if ($request->has('pdname2') && $request->has('pdvalue2')) {
                array_push($labels, $request->input("pdname2"));
                $valueTwo = explode(",", $request->input("pdvalue2"));
                array_push($allValues, $valueTwo);
                array_push($categories, $request->input('category2'));
            }
            if ($request->has('pdname3') && $request->has('pdvalue3')) {
                array_push($labels, $request->input("pdname3"));
                $valueThree = explode(",", $request->input("pdvalue3"));
                array_push($allValues, $valueThree);
                array_push($categories, $request->input('category3'));
            }
            if ($request->has('pdname4') && $request->has('pdvalue4')) {
                array_push($labels, $request->input("pdname4"));
                $valueFour = explode(",", $request->input("pdvalue4"));
                array_push($allValues, $valueFour);
                array_push($categories, $request->input('category4'));
            }
            if ($request->has('pdname5') && $request->has('pdvalue5')) {
                array_push($labels, $request->input("pdname5"));
                $valueFive = explode(",", $request->input("pdvalue5"));
                array_push($allValues, $valueFive);
                array_push($categories, $request->input('category5'));
            }
            if ($request->has('pdname6') && $request->has('pdvalue6')) {
                array_push($labels, $request->input("pdname6"));
                $valueSix = explode(",", $request->input("pdvalue6"));
                array_push($allValues, $valueSix);
                array_push($categories, $request->input('category6'));
            }

            $product = new M_Product();
            $product = $product->updateData($request, $id);

            $productDetail = new M_Product_Detail();
            $productDetail->deleteData($id);
            $phd = new T_AD_Photo();

            if ($request->input('hide1')  == "" &&  $request->hasFile('photo1')) {
                $path = $request->file('photo1')->storePublicly('ProductImage');
                $phd->insertImage($path, $product, 1);
            }
            if ($request->input('hide2') == "" && $request->hasFile('photo2')) {
                $path = $request->file('photo2')->storePublicly('ProductImage');
                $phd->insertImage($path, $product, 2);
            }

            if ($request->input('hide3') == "" && $request->hasFile('photo3')) {
                $path = $request->file('photo3')->storePublicly('ProductImage');
                $phd->insertImage($path, $product, 3);
            }
            if ($request->input('hide4') == "" && $request->hasFile('photo4')) {
                $path = $request->file('photo4')->storePublicly('ProductImage');
                $phd->insertImage($path, $product, 4);
            }
            if ($request->input('hide5') == "" && $request->hasFile('photo5')) {
                $path = $request->file('photo5')->storePublicly('ProductImage');
                $phd->insertImage($path, $product, 5);
            }
            if ($request->input('hide6') == "" && $request->hasFile('photo6')) {
                $path = $request->file('photo6')->storePublicly('ProductImage');
                $phd->insertImage($path, $product, 6);
            }


            for ($i = 0; $i < count($labels); $i++) {
                $value = $allValues[$i];
                for ($j = 0; $j < count($value); $j++) {
                    $order = $j + 1;
                    $productDetail->insert($product, $categories[$i], $labels[$i], $order, $value[$j]);
                }
            }
        });


        Log::channel('adminlog')->info("ProductController", [
            'End UpdateData'
        ]);

        return  redirect('productList');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
