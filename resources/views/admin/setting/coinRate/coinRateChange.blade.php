@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Coin Rate Change')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/adminLayout.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/commonAdmincss.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/coinRate.css') }}" />
@endsection

@section('script')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/adminAdd.js') }}"></script>
@endsection
@section('body')

    <div class="col-md-10">
        {{-- Starts Header Buttons --}}
        <div class="mt-4 ">
            <a href="{{ url()->previous() }}"><button
                    class="checked btn text-light  active btncust ">{{ __('messageZY.back') }}</button></a>
        </div>
        {{-- Starts Form --}}
        <form action="{{ route('coinrate.store') }}" method="POST" enctype="multipart/form-data">
            <div class="col-5  coinRateForm">
                @include('COMMON.component.coinRateAdd')

            </div>
        </form>
        {{-- <a href="{{ url()->previous() }}"><button class="change"
            id="back">{{ __('messageZY.back') }}</button></a> --}}
    </div>
@endsection
