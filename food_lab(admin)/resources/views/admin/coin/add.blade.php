@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Coin List')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/adminCoin.css') }}" />
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/adminAddCoin.js"></script>
@endsection
@section('body')
    @if (session('role') == 'SA')
        <div class="col-md-10">
            <div class="mt-4">
                <a href="coinListing" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.Listing') }}</button></a>
                <a href="" class="me-5"><button
                        class="btn text-light  active btncust">{{ __('messageLK.AddCoin') }}</button></a>
                <a href="rateChange" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.CoinRate') }}</button></a>
                <a href="rateHistory" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.CoinHistory') }}</button></a>
            </div>

            <div class="row mt-4">
                <div class="col-7">
                    <div class="d-flex align-items-center">
                        <span class="fs-5 w-10 me-3">CustomerID: </span> <input type="text"
                            class="form-control border border-dark searchBtn" id="customerID" required>
                        <span><button class="btn text-light active btncust" id="search">Search</button></span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center">
                        <a href="/customerInfo"><button class="btn text-light active btncust">Customer List</button></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="addCoinCustomer" method="POST" id="addCoinForm">
                        @csrf
                        <div class="border border-dark p-4">
                            <li class="lidisplay fs-4"><b>Nickname</b> : <span id="nickname"></span> </li>
                            <li class="lidisplay fs-4"> <b>Customer ID</b> : <span id="cid"></span> </li>
                            <li class="lidisplay fs-3 text-warning "> <b>Coin : <span id="coin"></span> </b> </li>
                            <li class="lidisplay fs-4"><b>Phone No.</b> : <span id="phone"></span> </li>

                            {{-- Add Coin --}}
                            <div class="fs-5 fw-bold mt-4">Add Coin</div>
                            <div class="input-group mb-3 received_amount">
                                <input type="number" class="form-control" id="recAmt" name="amount"
                                    aria-label="Recipient's username" aria-describedby="checkBtn" />
                            </div>
                            @error('amount')
                                <li class="text-danger ">{{ $message }}</li>
                            @enderror

                            {{-- Note --}}
                            <div class="form-floating mb-3 mt-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="note"
                                    style="height: 120px" name="note"></textarea>
                                <label for="note" class="fs-5">Note</label>
                                @error('note')
                                    <li class="text-danger ">{{ $message }}</li>
                                @enderror
                            </div>

                            <button type="submit" id="approve" class="btn btn-warning btn-lg  me-5">Add Coin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- For AD and Other --}}
    @else
        <div class="col-md-10">
            <div class="mt-4">
                <a href="coinListing" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.Listing') }}</button></a>
                <a href="" class="me-5"><button
                        class="btn text-light  active btncust">{{ __('messageLK.AddCoin') }}</button></a>
                <a href="rateHistory" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.CoinHistory') }}</button></a>
            </div>

            <div class="row mt-4">
                <div class="col-7">
                    <div class="d-flex align-items-center">
                        <span class="fs-5 w-10 me-3">CustomerID: </span> <input type="text"
                            class="form-control border border-dark searchBtn" id="customerID" required>
                        <span><button class="btn text-light active btncust" id="search">Search</button></span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center">
                        <a href="/customerInfo"><button class="btn text-light active btncust">Customer List</button></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="addCoinCustomer" method="POST" id="addCoinForm">
                        @csrf
                        <div class="border border-dark p-4">
                            <li class="lidisplay fs-4"><b>Nickname</b> : <span id="nickname"></span> </li>
                            <li class="lidisplay fs-4"> <b>Customer ID</b> : <span id="cid"></span> </li>
                            <li class="lidisplay fs-3 text-warning "> <b>Coin : <span id="coin"></span> </b> </li>
                            <li class="lidisplay fs-4"><b>Phone No.</b> : <span id="phone"></span> </li>

                            {{-- Add Coin --}}
                            <div class="fs-5 fw-bold mt-4">Add Coin</div>
                            <div class="input-group mb-3 received_amount">
                                <input type="number" class="form-control" id="recAmt" name="amount"
                                    aria-label="Recipient's username" aria-describedby="checkBtn" />
                            </div>
                            @error('amount')
                                <li class="text-danger ">{{ $message }}</li>
                            @enderror

                            {{-- Note --}}
                            <div class="form-floating mb-3 mt-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="note"
                                    style="height: 120px" name="note"></textarea>
                                <label for="note" class="fs-5">Note</label>
                                @error('note')
                                    <li class="text-danger ">{{ $message }}</li>
                                @enderror
                            </div>

                            <button type="submit" id="approve" class="btn btn-warning btn-lg  me-5">Add Coin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif


@endsection
