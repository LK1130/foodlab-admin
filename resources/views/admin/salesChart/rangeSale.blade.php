@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | {{ __('messageCPPK.Range Sales') }}
@endsection

@section('css')
    <!-- Join Css -->
    <link rel="stylesheet" href="css/adminSalesChart.css" />
@endsection

@section('script')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- For Jquary Cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- For Apex Charts Cdn-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="" type="text/javascript" defer></script> --}}
@endsection

@section('body')
    <div class="col-md-10">
        <div class="mt-4">
            <!-- Daily Sales Button -->
            <a href="dailyChart" class="me-5"><button id="dailySales"
                    class="btn text-light  inactive btncust">{{ __('messageCPPK.Daily') }}</button></a>
            <!--Monthly Sales Button -->
            <a href="monthlyChart" class="me-5"><button id="monthlySales"
                    class="btn text-light inactive btncust">{{ __('messageCPPK.Monthly') }}</button></a>
            <!-- Yearly Sales Button -->
            <a href="yearlyChart" class="me-5"><button id="yearlySales"
                    class="btn text-light inactive btncust">{{ __('messageCPPK.Yearly') }}</button></a>
            <!-- Range Sales Button -->
            <a href="rangeChart" class="me-5"><button id="rangeSales"
                    class="btn text-light active btncust">{{ __('messageCPPK.Range') }}</button></a>
        </div>
        <!-- For Range Sale Search -->
        <form action="/rangeChart" method="Post">
            @csrf
            <div id="rangeSearch">
                <!-- For  Start Range Search -->
                <input id="start-date" class="fromRangeCount" type="date" name="fromDate" required></input>
                <!-- For Between Symbol -->
                <h3 id="betweenSymbol">~</h3>
                <!-- For  End Range Search -->
                <input id="end-date" class="toRangeCount" type="date" name="toDate" required></input>
                <!-- Search Btn -->
                <span class="mx-3"><button class="btn btncust" id="rangeSearchSubmit">Search</button></span>
            </div>
            <div>
                <br></br>
                @if ($errors->has('fromDate'))
                    <span class="text-danger errorShow">First Input Box({{ $errors->first('fromDate') }})</span>
                @endif
                @if ($errors->has('toDate'))
                    <span class="text-danger errorShow">Second Input Box({{ $errors->first('toDate') }})</span>
                @endif
                <div>
        </form>
        <!-- For Yearly Sale Chart-->
        <div id="lineChart1">
            <!-- For showing Yearly Chart details-->
            <!-- For  Order Sale Chart-->
            <div id="chart">

            </div>
            <!-- For  Coin Sale Chart-->
            <div id="chart1">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-6">
            <table class="table table-success me-5 tbcust" id='ordertable'>
                <thead>
                    <tr class="tableth">
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Total Order</th>
                    </tr>
                </thead>
                <tbody class="scroll" id="orders">

                </tbody>
            </table>
        </div>
        <div class="col-6">
            <table class="table table-success me-5 tbcust" id="cointable">
                <thead>
                    <tr class="tableth">
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Total Amount</th>
                    </tr>
                </thead>
                <tbody class="scroll" id="coins">

                </tbody>
            </table>
        </div>
    </div>
    <script>
        // // {{-- For Sending Order Array to Order rangeChart.js --}}
        // var orderArrays = @json($orderArray);
        // // {{-- For Sending Coin Array to Coin rangeChart.js --}}
        // var coinArrays = @json($coinArray);
        // // {{-- For Sending order Array to Order rangeChart.js --}}
        // var orderDailys = @json($orderDaily);
        // // {{-- For Sending  coin Array to  Coin rangeChart.js --}}
        // var coinDailys = @json($coinDaily);
    </script>
    <!-- Join Javascript -->
    <script src="js/adminRangeChart.js"></script>
@endsection
