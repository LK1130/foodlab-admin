@extends('COMMON.layout.layout_cusotmer_2')

@section('title','Food Lab')

@section('css')
    <link rel="stylesheet" href="{{ url('css/maintenance.css') }}">
@endsection

@section('body')
    <div class="mains">
        <div class="d-flex flex-column align-items-center justify-content-center p-3">
            <div class="main-photos">
                <img src="{{ url('/storage/maintenance/maintenance.gif') }}" width="100%" alt="maintenance">
            </div>
            <p class="fs-1 fw-bolder text-uppercase pt-2 text-danger">Our Site is Currently maintenance.<br/>Try Again Later.</p>
        </div>
    </div>
@endsection