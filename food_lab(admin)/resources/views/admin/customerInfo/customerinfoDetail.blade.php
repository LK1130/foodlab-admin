@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | Customer Info Detail
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/customerinfoDetail.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admincustomerInfo.css') }}">
@endsection

@section('script')

@endsection


@section('body')
    <div class="col-md-10">
        <a href="customerInfo"><button class="btn btncust1 text-light mt-4">{{ __('messageZN.Back') }}</button></a>
        <div class="status text title fw-bold mb-4 mt-4">{{ __('messageZN.Cusinfodetail') }}</div>
        <div class="row">
            <div class="col-md-12">
                <div class="border border-dark">
                    <div class="d-flex justify-content-center my-3">
                        <div>
                            <p class="lidisplay  detail"><b>{{ __('messageZN.Nickname') }}</b></p>
                            <p class="lidisplay  detail"><b>{{ __('messageZN.Customer ID') }}</b></p>
                            <p class="lidisplay  detail"><b>{{ __('messageZN.Phoneno') }}</b></p>
                            <p class="lidisplay  detail"><b>{{ __('messageZN.Address') }}</b></p>
                        </div>
                        <div class="mx-2">
                            <p class="lidisplay  detail">:</p>
                            <p class="lidisplay  detail">:</p>
                            <p class="lidisplay  detail">:</p>
                            <p class="lidisplay  detail">:</p>
                        </div>
                        <div>
                            <p class="lidisplay  detail">{{ $cusdetail->nickname }}</p>
                            <p class="lidisplay  detail">{{ $cusdetail->customerID }}</p>
                            <p class="lidisplay  detail">{{ $cusdetail->phone }}</p>
                            <p class="lidisplay  detail">
                                {{ $cusdetail->state_name }} {{ $cusdetail->township_name }}
                                {{ $cusdetail->address3 }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row tabe">
                    <div class="col-md-6 mt-5 tablelist">
                        <div class="status text tableheaders fw-bold mt-6">{{ __('messageZN.order history') }}</div>
                        <table class="table boxshad">
                            <tr class="tableheader tablerows">
                                <th scope="col" rowspan="2">{{ __('messageZN.No') }}</th>
                                <th scope="col" rowspan="2">{{ __('messageZN.pay type') }}</th>
                                <th scope="col" colspan="2" class="text-center">Grand Total</th>
                                <th scope="col" rowspan="2">{{ __('messageZN.Order Status') }}</th>
                                <th scope="col" rowspan="2">{{ __('messageZN.Last Control') }}</th>
                                <th scope="col" rowspan="2">{{ __('messageZN.Date&t') }}</th>
                            </tr>
                            <tr class="tableheader tablerows">
                                <th>Coin</th>
                                <th>Cash</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($t_ad_order as $trans)
                                    <tr class="tablecolor1 tablerows">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        @if ($trans->payment == 0)
                                            <td scope="col">Coin</td>
                                        @else
                                            <td scope="col">C.O.D</td>
                                        @endif
                                        <td class="text-center" scope="col">{{ $trans->grandtotal_coin }}</td>
                                        <td class="text-center" scope="col">{{ $trans->grandtotal_cash }}</td>
                                        <td scope="col">{{ $trans->status }}</td>
                                        <td scope="col">{{ $trans->ad_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($trans->order_date)->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">There is no Data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if ($t_ad_order->hasPages())
                            <div class="d-flex justify-content-center">
                                {{ $t_ad_order->appends([
                                        'id' => $t_ad_order[0]->customer_id,
                                        'customerCoin' => $cuscoin->currentPage(),
                                    ])->links() }}
                            </div>

                        @endif

                    </div>
                    <div class="col-md-6 mt-5 tablelist">
                        <div class="status text fs-3 fw-bold mt-6">{{ __('messageZN.Coinchargehistory') }}</div>
                        <table class="table boxshad">
                            <thead>
                                <tr class="tableheader tablerows">
                                    <th scope="col">{{ __('messageZN.No') }}</th>
                                    <th scope="col">{{ __('messageZN.CoinA') }}</th>
                                    <th scope="col">{{ __('messageZN.Approve By') }}</th>
                                    <th scope="col">{{ __('messageZN.Reqtime') }}</th>
                                    <th scope="col">{{ __('messageZN.Status') }}</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                @forelse ($cuscoin as $coin)
                                    <tr class="tablecolor1 tablerows">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td scope="col">{{ $coin->request_coin }}</td>
                                        <td scope="col">{{ $coin->ad_name }}</td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($coin->request_datetime)->diffForHumans() }}
                                        </td>
                                        @if ($coin->status == 'Request')
                                            <td scope="col" class="text-success">{{ $coin->status }}</td>
                                        @elseif ($coin->status == 'Approve')
                                            <td scope="col" class="text-info">{{ $coin->status }}</td>
                                        @elseif ($coin->status == 'Waiting')
                                            <td scope="col" class="text-warning">{{ $coin->status }}</td>
                                        @elseif ($coin->status == 'Reject')
                                            <td scope="col" class="text-secondary">{{ $coin->status }}</td>
                                        @endif
                                        <td scope="col">
                                            <a href="detailCharge/{{ $coin->chargeid }}">
                                                <button class="btn tablerows btn-outline-dark"><i
                                                        class="bi bi-arrow-right"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">There is no Data.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        @if ($cuscoin->hasPages())
                            <div class="d-flex justify-content-center">
                                {{ $cuscoin->appends([
                                        'id' => $t_ad_order[0]->customer_id,
                                        'customerTrans' => $t_ad_order->currentPage(),
                                    ])->links() }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
