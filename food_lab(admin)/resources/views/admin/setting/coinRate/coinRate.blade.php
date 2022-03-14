@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Coin Rate')

@section('css')


    <link rel="stylesheet" href="{{ URL::asset('css/adminLayout.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/commonAdmincss.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/coinRate.css') }}" />
@endsection

@section('script')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/coinrate.js') }}"></script>
@endsection
@section('body')
    {{-- Starts Header Buttons --}}

    <div class="col-md-10 ">

        <div class="mt-4">
            <a href="{{ url('adminLogin') }}" class="me-5"><button
                    class="btn text-light   btncust">{{ __('messageZY.loginManage') }}</button></a>
            <a href="{{ url('coinrate') }}" class="me-5"><button
                    class="btn text-light active btncust">{{ __('messageZY.coinRate') }}</button></a>
            <a href="{{ url('siteManage') }}" class="me-5"><button
                    class="btn text-light   btncust">{{ __('messageZY.siteManager') }}</button></a>
        </div>
        @include('COMMON.component.coinRateHistory')
        <a href="{{ route('coinrate.create') }}" class="addAdminButton">
            <button class="btn text-light  active btncust ">{{ __('messageZY.change') }}</button>
        </a>
    </div>
@endsection
