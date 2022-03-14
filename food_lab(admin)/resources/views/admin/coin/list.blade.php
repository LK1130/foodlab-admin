@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Coin List')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/adminCoin.css') }}" />
@endsection

@section('script')

@endsection
@section('body')
    @if (session('role') == 'SA')
        <div class="col-md-10">
            <div class="mt-4">
                <a href="" class="me-5"><button
                        class="btn text-light  active btncust">{{ __('messageLK.Listing') }}</button></a>
                <a href="addCoin" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.AddCoin') }}</button></a>
                <a href="rateChange" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.CoinRate') }}</button></a>
                <a href="rateHistory" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.CoinHistory') }}</button></a>
            </div>
            @if ($errors->any())
                <p class="text-danger fw-bold fs-3">{{ $errors->first() }}</p>
            @endif
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-4 mt-4 title status">{{ __('messageLK.Request') }} ({{ $request->total() }})
                    </div>
                    <table class="table table-success  me-5 tbcust">
                        <thead>
                            <tr class="tableth">
                                {{-- <th scope="col" class="no" >No.</th> --}}
                                <th scope="col">Customer ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Request Coin</th>
                                <th scope="col">Request DateTime</th>
                                <th scope="col">Last Decision By</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll">
                            @forelse ($request as $item)
                                <tr class="text-light tabletd">
                                    {{-- <td scope="col" class="no">{{ $loop->index+1 }}.</td> --}}
                                    <td scope="col">{{ $item->customerID }}</td>
                                    <td scope="col">{{ $item->nickname }}</td>
                                    <td scope="col">{{ $item->request_coin }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($item->request_datetime)->diffForHumans() }}
                                    </td>
                                    <td scope="col">{{ $item->ad_name }}</td>
                                    <td>
                                        <a href="makeDecision/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-success"><i
                                                    class="bi bi-pencil-square"></i></button></a>
                                    </td>
                                </tr>
                            @empty
                                There is no data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex  justify-content-center">
                        {{ $request->appends([
                                'approve' => $approve->currentPage(),
                                'waiting' => $waiting->currentPage(),
                                'reject' => $reject->currentPage(),
                            ])->links() }}
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-4 mt-4 title status">{{ __('messageLK.Approve') }}
                        ({{ $approve->total() }})</div>
                    <table class="table table-primary me-5 tbcust">
                        <thead>
                            <tr class="tableth">
                                {{-- <th scope="col" class="no" >No.</th> --}}
                                <th scope="col">Customer ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Request Coin</th>
                                <th scope="col">Approved Time</th>
                                <th scope="col">Last Decision By</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll">
                            @forelse ($approve as $item)
                                <tr class="text-light tabletd">
                                    {{-- <td scope="col" class="no">{{ $loop->index+1 }}.</td> --}}
                                    <td scope="col">{{ $item->customerID }}</td>
                                    <td scope="col">{{ $item->nickname }}</td>
                                    <td scope="col">{{ $item->request_coin }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($item->updatetime)->diffForHumans() }}</td>
                                    <td scope="col">{{ $item->ad_name }}</td>
                                    <td>
                                        <a href="detailCharge/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-primary"><i
                                                    class="bi bi-arrow-right"></i></button></a>
                                    </td>
                                    <td>
                                        <a href="makeReDecision/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-primary"><i
                                                    class="bi bi-pencil-square"></i></button></a>
                                    </td>
                                </tr>
                            @empty
                                There is no data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex  justify-content-center">
                        {{ $approve->appends([
                                'request' => $request->currentPage(),
                                'waiting' => $waiting->currentPage(),
                                'reject' => $reject->currentPage(),
                            ])->links() }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-4 mt-4 title status">{{ __('messageLK.Waiting') }}
                        ({{ $waiting->total() }})</div>
                    <table class="table table-warning me-5 tbcust">
                        <thead>
                            <tr class="tableth">
                                {{-- <th scope="col" class="no" >No.</th> --}}
                                <th scope="col">Customer ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Request Coin</th>
                                <th scope="col">Decided Time</th>
                                <th scope="col">Last Decision By</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll">
                            @forelse ($waiting as $item)
                                <tr class="text-light tabletd">
                                    {{-- <td scope="col" class="no">{{ $loop->index+1 }}</td> --}}
                                    <td scope="col">{{ $item->customerID }}</td>
                                    <td scope="col">{{ $item->nickname }}</td>
                                    <td scope="col">{{ $item->request_coin }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($item->updatetime)->diffForHumans() }}</td>
                                    <td scope="col">{{ $item->ad_name }}</td>
                                    <td>
                                        <a href="detailCharge/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-warning"><i
                                                    class="bi bi-arrow-right"></i></button></a>
                                    </td>
                                    <td>
                                        <a href="makeDecision/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-warning"><i
                                                    class="bi bi-pencil-square"></i></button></a>
                                    </td>
                                </tr>
                            @empty
                                There is no data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex  justify-content-center">
                        {{ $waiting->appends([
                                'approve' => $approve->currentPage(),
                                'request' => $request->currentPage(),
                                'reject' => $reject->currentPage(),
                            ])->links() }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-4 mt-4 title status">{{ __('messageLK.Reject') }} ({{ $reject->total() }})
                    </div>
                    <table class="table me-5 table-secondary tbcust">
                        <thead>
                            <tr class="tableth">
                                {{-- <th scope="col" class="no" >No.</th> --}}
                                <th scope="col">Customer ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Request Coin</th>
                                <th scope="col">Reject Time</th>
                                <th scope="col">Last Decision By</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll">
                            @forelse ($reject as $item)
                                <tr class="text-light tabletd">
                                    {{-- <td scope="col" class="no">{{ $loop->index+1 }}.</td> --}}
                                    <td scope="col">{{ $item->customerID }}</td>
                                    <td scope="col">{{ $item->nickname }}</td>
                                    <td scope="col">{{ $item->request_coin }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($item->updatetime)->diffForHumans() }} </td>
                                    <td scope="col">{{ $item->ad_name }}</td>
                                    <td>
                                        <a href="detailCharge/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-secondary"><i
                                                    class="bi bi-arrow-right"></i></button></a>
                                    </td>
                                </tr>
                            @empty
                                There is no data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex  justify-content-center">
                        {{ $reject->appends([
                                'approve' => $approve->currentPage(),
                                'waiting' => $waiting->currentPage(),
                                'request' => $request->currentPage(),
                            ])->links() }}
                    </div>
                </div>
            </div>

        </div>
    @else
        <div class="col-md-10">
            <div class="mt-4">
                <a href="" class="me-5"><button
                        class="btn text-light  active btncust">{{ __('messageLK.Listing') }}</button></a>
                <a href="addCoin" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.AddCoin') }}</button></a>
                <a href="rateHistory" class="me-5"><button
                        class="btn text-light  inactive btncust">{{ __('messageLK.CoinHistory') }}</button></a>
            </div>
            @if ($errors->any())
                <p class="text-danger fw-bold fs-3">{{ $errors->first() }}</p>
            @endif
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-4 mt-4 title">{{ __('messageLK.Request') }} ({{ $request->total() }})</div>
                    <table class="table table-success  me-5 tbcust">
                        <thead>
                            <tr class="tableth">
                                {{-- <th scope="col" class="no" >No.</th> --}}
                                <th scope="col">Customer ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Request Coin</th>
                                <th scope="col">Request DateTime</th>
                                <th scope="col">Last Decision By</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll">
                            @forelse ($request as $item)
                                <tr class="text-light tabletd">
                                    {{-- <td scope="col" class="no">{{ $loop->index+1 }}.</td> --}}
                                    <td scope="col">{{ $item->customerID }}</td>
                                    <td scope="col">{{ $item->nickname }}</td>
                                    <td scope="col">{{ $item->request_coin }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($item->request_datetime)->diffForHumans() }}
                                    </td>
                                    <td scope="col">{{ $item->ad_name }}</td>
                                    <td>
                                        <a href="makeDecision/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-success"><i
                                                    class="bi bi-pencil-square"></i></button></a>
                                    </td>
                                </tr>
                            @empty
                                There is no data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex  justify-content-center">
                        {{ $request->appends([
                                'approve' => $approve->currentPage(),
                                'waiting' => $waiting->currentPage(),
                                'reject' => $reject->currentPage(),
                            ])->links() }}
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-4 mt-4 title">{{ __('messageLK.Approve') }} ({{ $approve->total() }})</div>
                    <table class="table table-primary me-5 tbcust">
                        <thead>
                            <tr class="tableth">
                                {{-- <th scope="col" class="no" >No.</th> --}}
                                <th scope="col">Customer ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Request Coin</th>
                                <th scope="col">Approved Time</th>
                                <th scope="col">Last Decision By</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll">
                            @forelse ($approve as $item)
                                <tr class="text-light tabletd">
                                    {{-- <td scope="col" class="no">{{ $loop->index+1 }}.</td> --}}
                                    <td scope="col">{{ $item->customerID }}</td>
                                    <td scope="col">{{ $item->nickname }}</td>
                                    <td scope="col">{{ $item->request_coin }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($item->updatetime)->diffForHumans() }}</td>
                                    <td scope="col">{{ $item->ad_name }}</td>
                                    <td>
                                        <a href="detailCharge/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-primary"><i
                                                    class="bi bi-arrow-right"></i></button></a>
                                    </td>
                                    <td>
                                        <a href="makeReDecision/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-primary"><i
                                                    class="bi bi-pencil-square"></i></button></a>
                                    </td>
                                </tr>
                            @empty
                                There is no data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex  justify-content-center">
                        {{ $approve->appends([
                                'request' => $request->currentPage(),
                                'waiting' => $waiting->currentPage(),
                                'reject' => $reject->currentPage(),
                            ])->links() }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-4 mt-4 title">{{ __('messageLK.Waiting') }} ({{ $waiting->total() }})</div>
                    <table class="table table-warning me-5 tbcust">
                        <thead>
                            <tr class="tableth">
                                {{-- <th scope="col" class="no" >No.</th> --}}
                                <th scope="col">Customer ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Request Coin</th>
                                <th scope="col">Decided Time</th>
                                <th scope="col">Last Decision By</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll">
                            @forelse ($waiting as $item)
                                <tr class="text-light tabletd">
                                    {{-- <td scope="col" class="no">{{ $loop->index+1 }}</td> --}}
                                    <td scope="col">{{ $item->customerID }}</td>
                                    <td scope="col">{{ $item->nickname }}</td>
                                    <td scope="col">{{ $item->request_coin }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($item->updatetime)->diffForHumans() }}</td>
                                    <td scope="col">{{ $item->ad_name }}</td>
                                    <td>
                                        <a href="detailCharge/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-warning"><i
                                                    class="bi bi-arrow-right"></i></button></a>
                                    </td>
                                    <td>
                                        <a href="makeDecision/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-warning"><i
                                                    class="bi bi-pencil-square"></i></button></a>
                                    </td>
                                </tr>
                            @empty
                                There is no data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex  justify-content-center">
                        {{ $waiting->appends([
                                'approve' => $approve->currentPage(),
                                'request' => $request->currentPage(),
                                'reject' => $reject->currentPage(),
                            ])->links() }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-4 mt-4 title">{{ __('messageLK.Reject') }} ({{ $reject->total() }})</div>
                    <table class="table me-5 table-secondary tbcust">
                        <thead>
                            <tr class="tableth">
                                {{-- <th scope="col" class="no" >No.</th> --}}
                                <th scope="col">Customer ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Request Coin</th>
                                <th scope="col">Reject Time</th>
                                <th scope="col">Last Decision By</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll">
                            @forelse ($reject as $item)
                                <tr class="text-light tabletd">
                                    {{-- <td scope="col" class="no">{{ $loop->index+1 }}.</td> --}}
                                    <td scope="col">{{ $item->customerID }}</td>
                                    <td scope="col">{{ $item->nickname }}</td>
                                    <td scope="col">{{ $item->request_coin }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($item->updatetime)->diffForHumans() }} </td>
                                    <td scope="col">{{ $item->ad_name }}</td>
                                    <td>
                                        <a href="detailCharge/{{ $item->chargeid }}"><button
                                                class="btn btn-outline-secondary"><i
                                                    class="bi bi-arrow-right"></i></button></a>
                                    </td>
                                </tr>
                            @empty
                                There is no data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex  justify-content-center">
                        {{ $reject->appends([
                                'approve' => $approve->currentPage(),
                                'waiting' => $waiting->currentPage(),
                                'request' => $request->currentPage(),
                            ])->links() }}
                    </div>
                </div>
            </div>

        </div>
    @endif

@endsection
