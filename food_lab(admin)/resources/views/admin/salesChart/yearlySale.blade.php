@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | {{ __('messageCPPK.Yearly Sales') }}
@endsection

@section('css')
    <!-- Join Css -->
    <link rel="stylesheet" href="css/adminSalesChart.css" />
@endsection

@section('script')
    <!-- For Jquary Cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- For Apex Charts Cdn-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                    class="btn text-light active btncust">{{ __('messageCPPK.Yearly') }}</button></a>
            <!-- Range Sales Button -->
            <a href="rangeChart" class="me-5"><button id="rangeSales"
                    class="btn text-light inactive btncust">{{ __('messageCPPK.Range') }}</button></a>
        </div>
        <!-- For Yearly Sale Chart-->
        <div id="lineChart">
            <!-- For showing Yearly Chart details-->
            <!-- For  Order Yearly Sale Chart-->
            <div id="chart">

            </div>
            <!-- For  Coin Yearly Sale Chart-->
            <div id="chart1">

            </div>
        </div>
        <div class="row tableContainer">
            {{-- Monthly Order Sale Table --}}
            <div class="col-6">
                <table class="table table-success me-5 tbcust">
                    <thead>
                        <tr class="tableth">
                            <th scope="col">No.</th>
                            <th scope="col">Year</th>
                            <th scope="col">Total Order</th>
                        </tr>
                    </thead>
                    <tbody class="scroll">
                        @forelse ($orderlistTable as $key => $list)
                            <tr class="tabletd">
                                <td scope="col">No. {{ $orderlistTable->firstItem() + $key }}</td>
                                <td scope="col">{{ $list->year }} </td>
                                <td scope="col">{{ $list->totalorder }} </td>
                            </tr>
                        @empty
                            <tr class="tabletd">
                                <td colspan="3" class="text-center">There is no data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{ $orderlistTable->links() }}</div>
            </div>
            {{-- Monthly Coin Sale Table --}}
            <div class="col-6">
                <table class="table table-success me-5 tbcust">
                    <thead>
                        <tr class="tableth">
                            <th scope="col">No.</th>
                            <th scope="col">Year</th>
                            <th scope="col">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody class="scroll">
                        @forelse ($coinlistTable as $key => $list)
                            <tr class="tabletd">
                                <td scope="col">No.{{ $coinlistTable->firstItem() + $key }}</td>
                                <td scope="col">{{ $list->year }} </td>
                                <td scope="col">{{ $list->totalAmount }} KS </td>
                            </tr>
                        @empty
                            <tr class="tabletd">
                                <td colspan="3" class="text-center">There is no data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{ $coinlistTable->links() }}</div>
            </div>
        </div>
        <!-- For Sending Array to YearlyChart.js -->
        <script>
            // For Sending Order Array to Order yearlyChart.js
            var orderArray = @json($orderArray);
            // For Sending Coin Array to Coin yearlyChart.js
            var coinArray = @json($coinArray);
            // For Sending Year Array to Order yearlyChart.js 
            var orderYearly = @json($orderYearly);
            // For Sending Year Array to  Coin yearlyChart.js
            var coinYearly = @json($coinYearly);
        </script>
        <!-- Join Javascript -->
        <script src="js/adminYearlyChart.js"></script>
    @endsection
