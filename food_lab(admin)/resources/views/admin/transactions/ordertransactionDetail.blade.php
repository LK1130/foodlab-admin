@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | Order Transaction Detail
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/adminOrdertransaction.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/adminordertransactionDetail.css') }}">
@endsection

@section('script')
@endsection


@section('body')
    <div class="col-md-10">

        <a href="orderTransaction"><button class="btn btncust text-light mt-4">{{ __('messageZN.Back') }}</button></a>
        <div class="status text fs-2 fw-bold mb-4 mt-4">{{ __('messageZN.Order Transaction Detail') }}</div>
        <div class="row ">
            <div class="col-md-12 roow">

                <div class="border border-dark p-3 ">
                    <div class="row position-relative ">
                        {{-- Name And ID --}}
                        <div class="col-md-6">
                            <div class="text-start ms-2 fs-4">
                                <li class="lidisplay "><b>{{ __('messageZN.Nickname') }}</b> :
                                    {{ $order->nickname }}</li>
                                <li class="lidisplay "> <b>{{ __('messageZN.Customer ID') }}</b>
                                    :<a
                                        href="customerinfoDetail?id={{ $order->customer_id }}">{{ $order->customerID }}</a>
                                </li>
                            </div>
                        </div>
                        {{-- Order Id And Date --}}
                        <div class="col-md-6">
                            <div class="text-end me-5 fs-4">
                                <li class="lidisplay"> <b>{{ __('messageZN.OrderID') }}</b> :{{ $order->orderid }}
                                </li>
                                <li class="lidisplay"><b>{{ __('messageZN.Date') }}</b> :
                                    {{ $order->order_date }}
                                    {{ $order->order_time }}</li>
                            </div>
                        </div>
                        <div class="row mainbox">
                            {{-- Table Inside --}}
                            <div class="col-md-12">
                                <table class="table boxshad ms-2 mt-5">
                                    <thead>
                                        <tr class="tableheader fs-5">
                                            <th scope="col">{{ __('messageZN.No') }}</th>
                                            <th scope="col">{{ __('messageZN.Product Name') }}</th>
                                            <th scope="col">{{ __('messageZN.Product ID') }}</th>
                                            <th scope="col">{{ __('messageZN.Coin') }}</th>
                                            <th scope="col">{{ __('messageZN.Quantity') }}</th>
                                            <th scope="col">{{ __('messageZN.Totalcoin') }}</th>
                                            <th scope="col">{{ __('messageZN.Totalcash') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orderdetail as $key => $list)
                                            <tr class="tablecolor1 fs-5">
                                                <th scope="row">{{ $orderdetail->firstItem() + $key }}</th>
                                                <td>{{ $list->product_name }}</td>
                                                <td>{{ $list->product_id }}</td>
                                                <td>{{ $list->coin }}</td>
                                                <td>{{ $list->quantity }}</td>
                                                <td>{{ $list->total_coin }}</td>
                                                <td>{{ $list->total_cash }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">There is no Data.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">{{ $orderdetail->links() }}</div>
                            </div>

                        </div>
                    </div>
                    <div class="row position-relative">
                        <div class="col-md-4">
                            <div class="text-start ms-4 fs-4 position-absolute bottom-0 start-0">
                                <p> <b>{{ __('messageZN.Last Control') }}</b> :{{ $order->ad_name }} </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center position-absolute bottom-0 start-50 translate-middle-x ">
                                <li class="lidisplay fs-4"><b>{{ __('messageZN.Order Status') }}</b></li>
                                <li class="lidisplay fs-4">{{ $order->status }}</li>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="text-end position-absolute bottom-0 end-0">
                                <li class="lidisplay fs-5 me-4"><b>{{ __('messageZN.Delivery') }}</b> :
                                    {{ $order->delivery_price }}</li>
                                @if ($order->grandtotal_coin > 0)
                                    <li class="lidisplay fs-3 me-4"><b>{{ __('messageZN.GrandTotalcoin') }} </b> :
                                        {{ $order->grandtotal_coin }}
                                    </li>
                                @else
                                    <li class="lidisplay fs-3 me-4"><b>{{ __('messageZN.GrandTotalcash') }}</b> :
                                        {{ $order->grandtotal_cash }}
                                    </li>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>



    </div>
@endsection
