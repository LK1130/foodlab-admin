@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | Order Transaction
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/adminOrdertransaction.css') }}">
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/orderTransaction.js') }}"></script>
@endsection


@section('body')
    <div class="col-md-10">
        <div class="mt-4">
            <a href="orderTransaction" class="me-5"><button
                    class="btn  text-light  topbtns btncust">{{ __('messageZN.Order Transaction') }}</button></a>
            <a href="coinchargeList"><button
                    class="btn  inactive text-light  topbtns ">{{ __('messageZN.Coin Charge List') }}</button></a>
        </div>
        <div class="status text tableheaders fw-bold mb-4 mt-4">{{ __('messageZN.Order Transaction') }}</div>
        <div class="row ">
            <div class="col-md-12 roow">
                <table class="table boxshad me-5">
                    <thead>
                        <tr class="tableheader tablerows">
                            <th scope="col">{{ __('messageZN.No') }}</th>
                            <th scope="col" class="text-center">{{ __('messageZN.Customer ID') }}</th>
                            <th scope="col" class="text-center">{{ __('messageZN.Payment') }}</th>
                            <th scope="col" class="text-center">{{ __('messageZN.GrandTotalcoin') }}</th>
                            <th scope="col" class="text-center">{{ __('messageZN.GrandTotalcash') }}</th>
                            <th scope="col" class="text-center">{{ __('messageZN.Order Status') }}</th>
                            <th scope="col" class="text-center">{{ __('messageZN.Last Control') }}</th>
                            <th scope="col">{{ __('messageZN.Date&Time') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($t_ad_order as $key => $trans)
                            <tr class="tablecolor1 tablerows">
                                <th scope="row">{{ $t_ad_order->firstItem() + $key }}</th>
                                <td class="text-center"><a
                                        href="customerinfoDetail?id={{ $trans->customer_id }}">{{ $trans->customerID }}</a>
                                </td>
                                @if ($trans->payment == 0)
                                    <td class="text-center">Coin</td>
                                @else
                                    <td class="text-center">C.O.D</td>
                                @endif
                                <td class="text-center">{{ $trans->grandtotal_coin }}</td>
                                <td class="text-center">{{ $trans->grandtotal_cash }}</td>
                                <td class="text-center">{{ $trans->status }}</td>
                                <td class="text-center">{{ $trans->ad_name }}</td>
                                <td>{{ $trans->order_date }}
                                    {{ $trans->order_time }}
                                </td>
                                <td>
                                    <a href="ordertransactionDetail?id={{ $trans->orderid }}">
                                        <button class="btn tablerows btn-outline-dark"><i
                                                class="bi bi-arrow-right"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">There is no Data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{ $t_ad_order->links() }}</div>
            </div>
        </div>



    </div>
@endsection
