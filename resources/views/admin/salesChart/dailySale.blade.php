@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | {{ __('messageCPPK.Daily Sales') }}
@endsection

@section('css')
    <!-- Join Css -->
    <link rel="stylesheet" href="css/adminSalesChart.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection

@section('script')
    <!-- For Jquary Cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- For Apex Charts Cdn-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"
        integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('body')
    <div class="col-md-10">
        <div class="mt-4">
            <!-- Daily Sales Button -->
            <a href="dailyChart" class="me-5"><button id="dailySales"
                    class="btn text-light  active btncust">{{ __('messageCPPK.Daily') }}</button></a>
            <!--Monthly Sales Button -->
            <a href="monthlyChart" class="me-5"><button id="monthlySales"
                    class="btn text-light inactive btncust">{{ __('messageCPPK.Monthly') }}</button></a>
            <!-- Yearly Sales Button -->
            <a href="yearlyChart" class="me-5"><button id="yearlySales"
                    class="btn text-light inactive btncust">{{ __('messageCPPK.Yearly') }}</button></a>
            <!-- Range Sales Button -->
            <a href="rangeChart" class="me-5"><button id="rangeSales"
                    class="btn text-light inactive btncust">{{ __('messageCPPK.Range') }}</button></a>
        </div>
        <!-- For Daily Chart-->
        <div id="lineChart">
            <!-- For showing Daily Chart details-->
            <!-- For  Order daily Sale Chart-->
            <div id="chart">

            </div>
            <!-- For  Coin daily Sale Chart-->
            <div id="chart1">

            </div>
        </div>

        <div class="row tableContainer">
            {{-- Daily Order Sale Table --}}
            <div class="col-6">
                <table class="table table-success me-5 tbcust">
                    <thead>
                        <tr class="tableth">
                            <th scope="col">No.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total Order</th>
                        </tr>
                    </thead>
                    <tbody class="scroll">
                        @forelse ($dailyorderlist as $key => $list)
                            <tr class="tabletd">
                                <td scope="col">No. {{ $dailyorderlist->firstItem() + $key }}</td>
                                <td scope="col">{{ $list->date }} </td>
                                <td scope="col">{{ $list->totalorder }} </td>
                            </tr>
                        @empty
                            <tr class="tabletd">
                                <td colspan="3" class="text-center">There is no data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{ $dailycoinlist->links() }}</div>
            </div>
            {{-- Daily Coin Sale Table --}}
            <div class="col-6">
                <table class="table table-success me-5 tbcust">
                    <thead>
                        <tr class="tableth">
                            <th scope="col">No.</th>
                            <th scope="col">Charge Date</th>
                            <th scope="col">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody class="scroll">
                        @forelse ($dailycoinlist as $key => $list)
                            <tr class="tabletd">
                                <td scope="col">No.{{ $dailycoinlist->firstItem() + $key }}</td>
                                <td scope="col">{{ $list->date }} </td>
                                <td scope="col">{{ $list->totalAmount }} KS </td>
                            </tr>
                        @empty
                            <tr class="tabletd">
                                <td colspan="3" class="text-center">There is no data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{ $dailycoinlist->links() }}</div>
            </div>

        </div>
    </div>

    <!-- For Sending Array to DailyChart.js -->
    <script>
        // For Sending Order Array to Order dailyChart.js
        var orderArray = @json($orderArray);
        // For Sending Coin Array to Coin dailyChart.js
        var coinArray = @json($coinArray);
        // For Sending daily Array to Order dailyChart.js 
        var orderDaily = @json($orderDaily);
        // For Sending daily Array to  Coin dailyChart.js
        var coinDaily = @json($coinDaily);
    </script>
    <!-- Join Javascript -->
    <script src="js/adminDailyChart.js"></script>
@endsection
