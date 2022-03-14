@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Site Manage')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/adminLayout.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/commonAdmincss.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/siteManage.css') }}" />
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="{{ URL::asset('js/siteManage.js') }}"></script>
@endsection
@section('body')
    {{-- Starts Header Buttons --}}
    <div class="col-md-10 ">
        <div class="mt-4">
            <a href="{{ url('adminLogin') }}" class="me-5"><button
                    class="btn text-light   btncust">{{ __('messageZY.loginManage') }}</button></a>
            <a href="{{ url('coinrate') }}" class="me-5"><button
                    class="btn text-light   btncust">{{ __('messageZY.coinRate') }}</button></a>
            <a href="{{ url('siteManage') }}" class="me-5"><button
                    class="btn text-light  active btncust">{{ __('messageZY.siteManager') }}</button></a>
        </div>
        {{-- Starts Table --}}
        <select class="form-select select" id="select" aria-label="Default select example">
            <option value="siteManage" selected>{{ __('messageZY.siteManage') }}</option>
            <option value="app">{{ __('messageZY.appManage') }}</option>
            <option value="news">{{ __('messageZY.newsmanage') }}</option>
        </select>
        <div id="site">
            <h2>{{ __('messageZY.siteedit') }}</h2>
            <form action="siteManage/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="rowInput">
                    <label for="name">{{ __('messageZY.sitename') }}</label>
                    <div class=" mb-3">
                        <input type="text" id="name" name="name" class="form-control w-25"
                            value="{{ $siteInfo == null ? '' : $siteInfo->site_name }}">
                        @error('name')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>

                </div>
                <div class="rowInput">
                    <label for="logo">{{ __('messageZY.sitelogo') }}</label>
                    <div class="showImageInitial">
                        <h2>{{ __('messageZY.sitecurrentimg') }}</h2>
                        <img id="imgInitial" @if ($siteInfo == null)
                        src="{{ url('img/logo.png') }}"
                    @else
                        src="/storage/siteLogo/{{ $siteInfo->site_logo }}"
                        @endif

                        class="py-2 px-2" />
                        <input type="text" class="hide" value="{{ $siteInfo->site_logo }}" name="oldSiteLogo">
                    </div>
                    <div class="showImageChange">
                        <h2>{{ __('messageZY.yourimage') }}</h2>
                        <img id="imageChange" src="" class="py-2 px-2" />
                    </div>
                    <div class="mb-3">
                        <input type="file" id="logo" name="logo" class="form-control w-25">
                    </div>
                </div>
                <div class="rowInput">
                    <label for="policy">{{ __('messageZY.privacy') }}</label>
                    <div class="mb-3">

                        <textarea id="policy" class="form-control textarea"
                            name="policy">{{ $siteInfo == null ? '' : $siteInfo->privacy_policy }}</textarea>


                        @error('policy')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>

                </div>
                <div class="rowInput">
                    <div class="checkbox">
                        <label for="maintenance">{{ __('messageZY.maintenance') }}</label>
                        @if ($siteInfo == null ? '' : $siteInfo->maintenance == 0)
                            <input type="checkbox" id="maintenance" class="form-check-input">
                        @else
                            <input type="checkbox" id="maintenance" class="form-check-input" checked>
                        @endif
                        @error('maintenance')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                        <input type="text" id="mvalue" value="" name="maintenance">
                    </div>
                </div>
                <div class="rowInput">
                    <label for="intro">{{ __('messageZY.introtext') }}</label>
                    <div class=" mb-3">
                        <textarea id="intro" class="form-control textarea"
                            name="intro">{{ $siteInfo == null ? '' : $siteInfo->intro }}</textarea>
                        @error('intro')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                </div>
                <div class="rowInput">
                    <label for="address">{{ __('messageZY.address') }}</label>
                    <div class=" mb-3">
                        <textarea id="address" class="form-control textarea"
                            name="address">{{ $siteInfo == null ? '' : $siteInfo->address }}</textarea>
                        @error('address')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                </div>
                <div class="rowInput">
                    <label for="phone1">{{ __('messageZY.phone1') }}</label>
                    <div class=" mb-3">
                        <input type="text" id="phone1" name="phone1" class="form-control w-25"
                            value="{{ $siteInfo == null ? '' : $siteInfo->phone1 }}">
                        @error('phone1')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>

                </div>
                <div class="rowInput">
                    <label for="phone2">{{ __('messageZY.phone2') }}</label>
                    <div class=" mb-3">
                        <input type="text" id="phone2" name="phone2" class="form-control w-25"
                            value="{{ $siteInfo == null ? '' : $siteInfo->phone2 }}">
                        @error('phone2')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>

                </div>
                <div class="rowInput">
                    <label for="phone3">{{ __('messageZY.phone3') }}</label>
                    <div class=" mb-3">
                        <input type="text" id="phone3" name="phone3" class="form-control w-25"
                            value="{{ $siteInfo == null ? '' : $siteInfo->phone3 }}">
                        @error('phone3')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>

                </div>
                <div class="rowInput">
                    <label for="gmail">{{ __('messageZY.gmail') }}</label>
                    <div class=" mb-3">
                        <input type="email" id="gmail" name="gmail" class="form-control w-25"
                            value="{{ $siteInfo == null ? '' : $siteInfo->gmail }}">
                        @error('gmail')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>

                </div>
                <button type="submit"
                    class="btn text-light addAdminButton active btncust ms-4">{{ __('messageZY.save') }}</button>
            </form>
        </div>
    </div>
@endsection
