@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Admin Add')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/adminLayout.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/commonAdmincss.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/adminAdd.css') }}" />
@endsection

@section('script')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/adminAdd.js') }}"></script>
@endsection
@section('body')
    {{-- Starts Header Buttons --}}
    <div class="col-md-10 ">
        <div class="mt-4">
            <a href="{{ url('adminLogin') }}"><button
                    class="checked btn text-light  active btncust ">{{ __('messageZY.back') }}</button></a>
        </div>
        {{-- Starts Form --}}

        <div class="adminAddForm">

            <form action="{{ route('adminLogin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p class="formHeader">{{ __('messageZY.addAdmin') }} </p>
                <div>
                    <div class="form-group">
                        <label for="username">{{ __('messageZY.username') }}</label>
                        <input type="text" class="form-control" id="username" name="username">
                        @error('username')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('messageZY.password') }}</label>
                        <div class="relative w-50">
                            <ion-icon name="eye-off-outline" class="fs-3 mt-1" id="icon"></ion-icon>
                            <input type="password" class="form-control w-100" id="password" name="password">

                        </div>

                        @error('password')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">{{ __('messageZY.role') }}</label>
                        <select class="form-control" id="role" name="role">
                            <option>{{ __('messageZY.sa') }}</option>
                            <option>{{ __('messageZY.ad') }}</option>
                            <option>{{ __('messageZY.ka') }}</option>
                            <option>{{ __('messageZY.dl') }}</option>
                        </select>
                        @error('role')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <div class="relative">
                            <label for="validation">{{ __('messageZY.valid') }}</label>
                            <input type="checkbox" class="mt-2 " id="validate" checked>
                        </div>

                        @error('validate')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <button type="submit"
                            class="btn text-light addAdminButton active btncust mt-4">{{ __('messageZY.addAdmin') }}</button>
                    </div>
                </div>
                <input type="text" id="validateInteger" value="" name="validate">
            </form>

        </div>
    </div>
@endsection
