@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Category Add')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/adminLayout.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/commonAdmincss.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/adminAdd.css') }}" />
@endsection

@section('script')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/sliderEdit.js') }}"></script>
@endsection
@section('body')
    {{-- Starts Header Buttons --}}
    <div class="col-md-10 ">
        <div class="mt-4">
            <a href="{{ route('app.index') }}"><button
                    class="btn text-light active btncust">{{ __('messageZY.back') }}</button></a>
        </div>
        {{-- Starts Form --}}

        <div class="sliderImageSho" id="sliderImageShow">
            <label class="ms-2">{{ __('messageZY.yourSliderImage') }}</label>
            <img src="{{ $slider->image }}" id="chosenImage">
        </div>
        <div class="adminAddForm">
            <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p class="formHeader">{{ __('messageZY.editSlider') }} </p>
                <div>
                    <div class="form-group">
                        <label for="title">{{ __('messageZY.title') }}</label>
                        <input type="text" class="form-control w-50" id="title" name="title"
                            value="{{ $slider->banner_title }}">
                        @error('title')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="detail">{{ __('messageZY.detail') }}</label>
                        <input type="text" class="form-control w-50" id="detail" name="detail"
                            value="{{ $slider->banner_detail }}">
                        @error('detail')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group  mt-3">
                        <label for="buttonSlider">{{ __('messageZY.buttonStatus') }}</label>
                        <input type="checkbox" class="form-check-input" id="buttonSlider"
                            @if ($slider->button_state == 1) checked @endif>
                        @error('buttonSlider')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                        <input class="displayNone" id="buttonStatus" name="buttonStatus"></input>
                    </div>
                    <div class="buttonDiv" id="buttonDiv">
                        <div class="form-group mt-3">
                            <label for="buttonText">{{ __('messageZY.buttonText') }}</label>
                            <input type="text" class="form-control" id="buttonText" name="buttonText"
                                value="{{ $slider->button_text }}">
                            @error('buttonText')
                                <li class="text-danger ">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="buttonLink">{{ __('messageZY.buttonLink') }}</label>
                            <input type="text" class="form-control" id="buttonLink" name="buttonLink"
                                value="{{ $slider->button_link }}">
                            @error('buttonLink')
                                <li class="text-danger ">{{ $message }}</li>
                            @enderror
                        </div>
                    </div>
                    <div class=" mt-3 d-flex flex-row gap-2">
                        <label for="sliderImage">{{ __('messageZY.sliderImage') }}</label>
                        <input type="file" class="form-control w-25 ms-5" id="sliderImage" name="sliderImage">
                        @error('sliderImage')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn text-light  active btncust mt-5">{{ __('messageZY.save') }}</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
