@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Township Edit')

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
            <a href="{{ route('app.index') }}"><button
                    class="btn text-light active btncust">{{ __('messageZY.back') }}</button></a>
        </div>
        {{-- Starts Form --}}

        <div class="adminAddForm">

            <form action="{{ route('township.update', $township->id) }}" method="POST">
                @csrf
                @method('PUT')
                <p class="formHeader">{{ __('messageZY.edittownship') }} </p>
                <div>
                    <div class="form-group">
                        <label for="township">{{ __('messageZY.township') }}</label>
                        <input type="text" class="form-control" name="township_name"
                            value="{{ $township->township_name }}">
                        @error('township_name')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dlprice">{{ __('messageZY.deliveryprice') }}</label>
                        <input type="number" class="form-control" name="dlprice"
                            value="{{ $township->delivery_price }}">
                        @error('dlprice')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="note">{{ __('messageZY.note') }}</label>
                        <input type="text" class="form-control" name="note" value="{{ $township->note }}">
                        @error('note')
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
