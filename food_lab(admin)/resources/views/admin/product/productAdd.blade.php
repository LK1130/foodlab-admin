@extends('COMMON.layout.layout_admin')

@section('title', 'Admin | Product Add')


@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/adminProduct.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/adminProductTagInput.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection



@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/adminProductTagsInput.js') }}"></script>
    <script src="{{ URL::asset('js/adminProductForm.js') }}"></script>
@endsection

@section('body')
     <div class="col-md-10">

        
       <div class="d-flex justify-content-start ">
        <a href="/productList"><button class="btn btncust1 text-light mt-4">{{ __('messageAMK.Back') }}</button></a>
       </div>
            {{-- Product Form --}}
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="status text title mt-4 mb-4 labels">{{ __('messageAMK.ProductsAdd Form') }}</div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7 col-sm-12">

                        <div class="mt-2  image-container">
                            <div class="row">
                                <div class="col-md-6 col-sm-10">
                                    <div class="mx-5 mt-4 p-4 blocks">
                                        <img id="img1" class="img-thumbnail" src="" alt="">
                                    </div>

                                    <div class="form-group mx-4 mt-2">
                                        <input type="file" name="photo1" id="photoone" class="form-control files"
                                            accept="image/*">
                                        @error('photo1')
                                            <li class="text-danger ">{{ __('messageAMK.Product Photo is required') }}</li>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-10">
                                    <div class="mx-5 mt-4 p-4 blocks">
                                        <img id="img2" class="img-thumbnail" src="" alt="">
                                    </div>
                                    <div class="form-group mx-4 mt-2">
                                        <input type="file" name="photo2" id="phototwo" class="form-control files"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-10">
                                    <div class="mx-5 mt-4 p-4 blocks">
                                        <img id="img3" class="img-thumbnail" src="" alt="">
                                    </div>

                                    <div class="form-group mx-4 mt-2">
                                        <input type="file" name="photo3" id="photothree" class="form-control files"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-10">
                                    <div class="mx-5 mt-4 p-4 blocks">
                                        <img id="img4" class="img-thumbnail" src="" alt="">
                                    </div>

                                    <div class="form-group mx-4 mt-2">
                                        <input type="file" name="photo4" id="photofour" class="form-control files"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-10">
                                    <div class="mx-5 mt-4 p-4 blocks">
                                        <img id="img5" class="img-thumbnail" src="" alt="">
                                    </div>

                                    <div class="form-group mx-4 mt-2 mb-3">
                                        <input type="file" name="photo5" id="photofive" class="form-control files"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-10">
                                    <div class="mx-5 mt-4 p-4 blocks">
                                        <img id="img6" class="img-thumbnail" src="" alt="">
                                    </div>

                                    <div class="form-group mx-4 mt-2 mb-3">
                                        <input type="file" name="photo6" id="photosix" class="form-control files"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Product Form --}}
                    <div class="mt-2 col-md-5 col-sm-10">
                        <div class="form-group">
                            <label for="pname" class="form-label titles">{{ __('messageAMK.ProductName') }}</label>
                            <input type="text" name="pname" id="pname" class="form-control inputs"
                                value="{{ old('pname') }}">
                            @error('pname')
                                <li class="text-danger ">{{ __('messageAMK.ProductName is required') }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ptaste" class="form-label titles">{{ __('messageAMK.Taste') }}</label>
                            <select name="ptaste" id="ptaste" class="form-select selects" required>
                                @foreach ($mTaste as $item)
                                    <option value="{{ $item->id }}">{{ $item->taste }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="ptype" class="form-label titles">{{ __('messageAMK.Type') }}</label>
                            <select name="ptype" id="ptype" class="form-select selects" required>
                                {{-- <option value="0" selected disabled>Choose Type</option> --}}
                                @foreach ($mFav as $item)
                                    <option value="{{ $item->id }}">{{ $item->favourite_food }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="coin" class="form-label titles">{{ __('messageAMK.CoinAmount') }}</label>
                            <input type="number" name="coin" id="coin" class="form-control inputs" min="0"
                                value="{{ old('coin') }}">
                            @error('coin')
                                <li class="text-danger ">
                                    {{ __("messageAMK.Coin must be filled and negative sign can't assign.") }}</li>
                            @enderror
                            <div class="d-flex justify-content-center">
                                <p class="mx-3 mt-2 fs-4 fw-bold amounts text-danger" id="rate">0 MMK</p>
                            </div>

                        </div>


                        <div class="d-flex justify-content-between  mt-4 mx-2">
                            <div class="mx-2">
                                <label name="avaliable" class="titles">{{ __('messageAMK.Avaliable') }}</label>

                            </div>
                            <div class="mt-2">
                                <input type="checkbox" name="avaliable" id="avaliable" class="custombox" checked
                                    value="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product Description --}}
            <div class="container-fluid mb-4">
                <div class="row">

                    <div class="col-md-10 col-sm-12">
                        <div class="form-group">
                            <label for="list" class="form-label titles">{{ __('messageAMK.Ingredient') }}</label>
                            <textarea type="text" name="list" id="list" class="form-control inputs" rows="5"
                                value="{{ old('list') }}">{{ old('list') }}</textarea>
                            @error('list')
                                <li class="text-danger ">{{ __("messageAMK.Product's ingredient list is required.") }}</li>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-12">
                        <div class="form-group mt-3">
                            <label for="pdesc" class="form-label titles">{{ __('messageAMK.Description') }}</label>
                            <textarea name="pdesc" id="pdesc" class="form-control" cols="30"
                                rows="10">{{ old('pdesc') }}</textarea>
                        </div>
                        @error('pdesc')
                            <li class="text-danger ">{{ __("messageAMK.Product's Description is required.") }}</li>
                        @enderror
                    </div>
                </div>
            </div>


            {{-- Product Append --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mb-3">
                        <div class="mt-4 mb-2 titles">{{ __('messageAMK.ProductDetail') }}</div>
                        <div class="appendBox">
                            <div class="m-3 plusBox">
                                <i class="fas fa-plus-circle icons"></i>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-8">
                                    <div class="append">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end mb-4">
                        <div class="col-md-3">
                        <button type="button"  onclick='location.reload();'  class="resetBtn">{{ __('messageAMK.Reset') }}</button>
                        
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="submitBtn">{{ __('messageAMK.Submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>
    <script>
        var rate = @json($rates->rate);
    </script>
    <script src="{{ URL::asset('js/adminProductCalculate.js') }}"></script>
@endsection
