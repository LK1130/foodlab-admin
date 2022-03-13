@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | Dashboard
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/adminDashbord.css') }}">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"
        integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection


@section('body')
    @if (session('role') == 'SA')
        <div class="col-md-10">
            {{-- Top Noti Start --}}
            <div class="notifications mt-4">
                {{-- Suggest --}}
                <a href="customerSuggest">
                    <button type="button" class="btn btn-lg btn-outline-dark position-relative me-3 fs-4">
                        <i class="bi bi-card-checklist"></i>
                        @if ($sugcount == 0)
                        @else
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $sugcount }}
                            </span>
                        @endif
                    </button></a>
                {{-- Contact --}}
                <a href="customerContact">
                    <button type="button" class="btn btn-lg lg btn-outline-dark position-relative me-3 fs-4">
                        <i class="bi bi-person-lines-fill"></i>
                        @if ($concount == 0)
                        @else
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $concount }}
                            </span>
                        @endif

                    </button></a>
                {{-- Report --}}
                <a href="customerReport">
                    <button type="button" class="btn btn-lg lg btn-outline-danger position-relative me-3 fs-4">
                        </i><i class="bi bi-exclamation-triangle"></i>
                        @if ($rpcount == 0)
                        @else
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $rpcount }}
                            </span>
                        @endif

                    </button></a>
            </div>
            {{-- Top Noti End --}}

            {{-- Status Start --}}
            <div class="status text title fw-bold mb-2">{{ __('messageZN.Status') }}</div>
            <div class="row mx-auto stbox">
                <div class="col a stats">
                    <div class="text-center  stat ">
                        <p class=" numbers tcount">{{ $tcount }}</p>
                        <p class="detail dep">{{ __('messageZN.Total Transaction') }}</p>
                        <a href="orderTransaction" class="fs-5 see">{{ __('messageZN.See More Detail') }}</a>
                    </div>
                </div>
                <div class="col a  stats">
                    <div class="text-center pb-4 stat">
                        <p class=" numbers cuscount">{{ $cuscount }}</p>
                        <p class="detail">{{ __('messageZN.Total Register') }}</p>
                        <a href="customerInfo" class="fs-5 see">{{ __('messageZN.See More Detail') }}</a>
                    </div>
                </div>
                <div class="col a  stats">
                    <div class="text-center pb-3 stat">
                        <p class=" numbers coinrate" id="coin">{{ $coinrate->rate }} </p>

                        <p class="detail">{{ __('messageZN.Coin Rate') }}</p>
                        <a href="orderTransaction" class="fs-5 see">{{ __('messageZN.See More Detail') }}</a>
                    </div>
                </div>
                <div class="col a  stats">
                    <div class="text-center pb-3 stat">
                        <p class=" numbers todaycount">{{ $todaycount }}</p>
                        <p class="detail">{{ __('messageZN.Today Order') }}</p>
                        <a href="orderTransaction" class="fs-5 see">{{ __('messageZN.See More Detail') }}</a>
                    </div>
                </div>
                <div class="col a  stats">
                    <div class="text-center stat">
                        <h3 class=" pb-1">{{ __('messageZN.Top 3') }}</h3>
                        @forelse ($top as $top3)
                            <p class="detail ">{{ $loop->iteration }}.{{ $top3->product_name }}</p>
                        @empty
                            No Item
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- Status End --}}
            {{-- Listing Start --}}
            {{-- <div class="status text fs-2 fw-bold mb-4 mt-5">{{ __('messageZN.Listing') }}</div> --}}
            <div class="row mt-4">
                <div class="col-md-6 tablelist">
                    {{-- Transaction List --}}
                    <div class="status text tableheaders fw-bold mb-2">{{ __('messageZN.Transaction List') }}</div>
                    <table class="table boxshad">
                        <thead>
                            <tr class="tableheader tablerows ">
                                <th scope="col">{{ __('messageZN.No') }}</th>
                                <th scope="col">{{ __('messageZN.Customer ID') }}</th>
                                <th scope="col">{{ __('messageZN.Payment') }}</th>
                                <th scope="col">{{ __('messageZN.Status') }}</th>
                                <th scope="col">{{ __('messageZN.Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orderdetail as $list2)
                                <tr class="tablecolor1 tablerows">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $list2->customerID }}</td>
                                    @if ($list2->payment == 0)
                                        <td>Coin</td>
                                    @else
                                        <td>C.O.D</td>
                                    @endif
                                    <td>{{ $list2->status }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($list2->order_date)->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">There is no Data.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <a href="orderTransaction" class=""><button
                            class="btn seemore text-light">{{ __('messageZN.See More') }}</button></a>
                </div>
                <div class="col-md-6 tablelist">
                    {{-- Customer Info --}}
                    <div class="status text tableheaders fw-bold mb-2">{{ __('messageZN.Customers List') }}</div>
                    <table class="table boxshad">
                        <thead>
                            <tr class="tableheader tablerows">
                                <th scope="col">{{ __('messageZN.No') }}</th>
                                <th scope="col">{{ __('messageZN.Nickname') }}</th>
                                <th scope="col">{{ __('messageZN.Cus ID') }}</th>
                                <th scope="col">{{ __('messageZN.Address') }}</th>
                                <th scope="col">{{ __('messageZN.Ph No') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($t_cu_customer as $list1)
                                <tr class="tablecolor1 tablerows">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $list1->nickname }}</td>
                                    <td>{{ $list1->customerID }}</td>
                                    <td>{{ $list1->state_name }} {{ $list1->township_name }} {{ $list1->address3 }}
                                    </td>
                                    <td>{{ $list1->phone }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">There is no Data.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <a href="customerInfo" class=""><button
                            class="btn seemore text-light">{{ __('messageZN.See More') }}</button></a>
                </div>
            </div>
            <div class="row space">
                <div class="col-md-6 tablelist">
                    {{-- Product List --}}
                    <div class="status text tableheaders fw-bold mb-2">{{ __('messageZN.Product List') }}</div>
                    <table class="table boxshad">
                        <thead>
                            <tr class="tableheader tablerows">
                                <th scope="col">{{ __('messageZN.No') }}</th>
                                <th scope="col">{{ __('messageZN.Product Name') }}</th>
                                <th scope="col">{{ __('messageZN.Coin Amount') }}</th>
                                <th scope="col">{{ __('messageZN.Type') }}</th>
                                <th scope="col">{{ __('messageZN.Taste') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($product as $list3)
                                <tr class="tablecolor1 tablerows">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $list3->product_name }}</td>
                                    <td>{{ $list3->coin }}/{{ $list3->amount }}</td>
                                    <td>{{ $list3->favourite_food }}</td>
                                    <td>{{ $list3->taste }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">There is no Data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="/productList" class="d-flex justify-content-end"><button
                            class="btn seemore text-light">{{ __('messageZN.See More') }}</button></a>
                </div>
                <div class="col-md-6 tablelist">
                    {{-- Coin Charge List --}}
                    <div class="status text tableheaders fw-bold mb-2">{{ __('messageZN.Coin Charge List') }}</div>
                    <table class="table boxshad">
                        <thead>
                            <tr class="tableheader tablerows">
                                <th scope="col">{{ __('messageZN.No') }}</th>
                                <th scope="col">{{ __('messageZN.Customer ID') }}</th>
                                <th scope="col">{{ __('messageZN.Approve By') }}</th>
                                <th scope="col">{{ __('messageZN.CoinA') }}</th>
                                <th scope="col">{{ __('messageZN.Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($coincharge as $list4)
                                <tr class="tablecolor1 tablerows">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $list4->customerID }}</td>
                                    <td>{{ $list4->ad_name }}</td>
                                    <td>{{ $list4->request_coin }}</td>
                                    @if ($list4->status == 'Request')
                                        <td class="text-success ">{{ $list4->status }}</td>
                                    @elseif ($list4->status == 'Approve')
                                        <td class="text-info ">{{ $list4->status }}</td>
                                    @elseif ($list4->status == 'Waiting')
                                        <td class="text-warning stshadow">{{ $list4->status }}</td>
                                    @elseif ($list4->status == 'Reject')
                                        <td class="text-secondary ">{{ $list4->status }}</td>
                                    @endif

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">There is no Data.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <a href="coinchargeList" class=""><button
                            class="btn seemore text-light ">{{ __('messageZN.See More') }}</button></a>
                </div>
            </div>
            {{-- For AD and Other --}}
        @else
            <div class="col-md-10">
                {{-- Top Noti Start --}}
                <div class="d-flex justify-content-end bd-highlight mt-4">
                    {{-- Suggest --}}
                    <a href="customerSuggest">
                        <button type="button" class="btn btn-lg btn-outline-dark position-relative mx-3 fs-4">
                            <i class="bi bi-card-checklist"></i>
                            @if ($sugcount == 0)
                            @else
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $sugcount }}
                                </span>
                            @endif
                        </button></a>
                    {{-- Contact --}}
                    <a href="customerContact">
                        <button type="button" class="btn btn-lg lg btn-outline-dark position-relative mx-3 fs-4">
                            <i class="bi bi-person-lines-fill"></i>
                            @if ($concount == 0)
                            @else
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $concount }}
                                </span>
                            @endif

                        </button></a>
                    {{-- Report --}}
                    <a href="customerReport">
                        <button type="button" class="btn btn-lg lg btn-outline-danger position-relative mx-3 fs-4">
                            </i><i class="bi bi-exclamation-triangle"></i>
                            @if ($rpcount == 0)
                            @else
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $rpcount }}
                                </span>
                            @endif

                        </button></a>
                </div>
                {{-- Top Noti End --}}

                {{-- Status Start --}}
                <div class="status text title fw-bold mb-2">{{ __('messageZN.Status') }}</div>
                <div class="row mx-auto stbox">
                    <div class="col a stats">
                        <div class="text-center  stat ">
                            <p class=" numbers tcount">{{ $tcount }}</p>
                            <p class="detail dep">{{ __('messageZN.Total Transaction') }}</p>
                            <a href="orderTransaction" class="fs-5 see">{{ __('messageZN.See More Detail') }}</a>
                        </div>
                    </div>
                    <div class="col a  stats">
                        <div class="text-center pb-4 stat">
                            <p class=" numbers cuscount">{{ $cuscount }}</p>
                            <p class="detail">{{ __('messageZN.Total Register') }}</p>
                            <a href="customerInfo" class="fs-5 see">{{ __('messageZN.See More Detail') }}</a>
                        </div>
                    </div>
                    <div class="col a  stats">
                        <div class="text-center pb-3 stat">
                            <p class=" numbers coinrate" id="coin">{{ $coinrate->rate }} </p>
                            <p class="detail">{{ __('messageZN.Coin Rate') }}</p>
                            <a href="orderTransaction" class="fs-5 see">{{ __('messageZN.See More Detail') }}</a>
                        </div>
                    </div>
                    <div class="col a  stats">
                        <div class="text-center pb-3 stat">
                            <p class=" numbers">{{ $todaycount }}</p>
                            <p class="detail">{{ __('messageZN.Today Order') }}</p>
                            <a href="orderTransaction" class="fs-5 see">{{ __('messageZN.See More Detail') }}</a>
                        </div>
                    </div>
                    <div class="col a  stats">
                        <div class="text-center stat">
                            <h3 class=" pb-1">{{ __('messageZN.Top 3') }}</h3>
                            @forelse ($top as $top3)
                                <p class="detail ">{{ $loop->iteration }}.{{ $top3->product_name }}</p>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">There is no Data.</td>
                                </tr>
                            @endforelse
                        </div>
                    </div>
                </div>
                {{-- Status End --}}
                {{-- Listing Start --}}
                {{-- <div class="status text fs-2 fw-bold mb-4 mt-5">{{ __('messageZN.Listing') }}</div> --}}
                <div class="row mt-4 ">
                    <div class="col-md-12 tablelist">
                        {{-- Customer Info --}}
                        <div class="status text tableheaders fw-bold mb-2">{{ __('messageZN.Customers List') }}</div>
                        <table class="table boxshad">
                            <thead>
                                <tr class="tableheader tablerows">
                                    <th scope="col">{{ __('messageZN.No') }}</th>
                                    <th scope="col">{{ __('messageZN.Nickname') }}</th>
                                    <th scope="col">{{ __('messageZN.Cus ID') }}</th>
                                    <th scope="col">{{ __('messageZN.Address') }}</th>
                                    <th scope="col">{{ __('messageZN.Ph No') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($t_cu_customer as $list1)
                                    <tr class="tablecolor1 tablerows">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $list1->nickname }}</td>
                                        <td>{{ $list1->customerID }}</td>
                                        <td>{{ $list1->state_name }} {{ $list1->township_name }}
                                            {{ $list1->address3 }}
                                        </td>
                                        <td>{{ $list1->phone }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">There is no Data.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <a href="customerInfo" class=""><button
                                class="btn seemore text-light">{{ __('messageZN.See More') }}</button></a>
                    </div>
                </div>
                <div class="row space">
                    <div class="col-md-12 tablelist">
                        {{-- Coin Charge List --}}
                        <div class="status text tableheaders fw-bold mb-2">{{ __('messageZN.Coin Charge List') }}</div>
                        <table class="table boxshad">
                            <thead>
                                <tr class="tableheader tablerows">
                                    <th scope="col">{{ __('messageZN.No') }}</th>
                                    <th scope="col">{{ __('messageZN.Customer ID') }}</th>
                                    <th scope="col">{{ __('messageZN.Approve By') }}</th>
                                    <th scope="col">{{ __('messageZN.CoinA') }}</th>
                                    <th scope="col">{{ __('messageZN.Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coincharge as $list4)
                                    <tr class="tablecolor1 tablerows">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $list4->customerID }}</td>
                                        <td>{{ $list4->ad_name }}</td>
                                        <td>{{ $list4->request_coin }}</td>
                                        @if ($list4->status == 'Request')
                                            <td class="text-success ">{{ $list4->status }}</td>
                                        @elseif ($list4->status == 'Approve')
                                            <td class="text-info ">{{ $list4->status }}</td>
                                        @elseif ($list4->status == 'Waiting')
                                            <td class="text-warning stshadow">{{ $list4->status }}</td>
                                        @elseif ($list4->status == 'Reject')
                                            <td class="text-secondary ">{{ $list4->status }}</td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">There is no Data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
    @endif


    <script>
        // for transaction count
        var tcount = @json($tcount);
        // for customer count
        var cuscount = @json($cuscount);
        // for coinrate
        var coinrate = @json($coinrate->rate);
        //for todayorder
        var toadyorder = @json($todaycount);
    </script>
    <script src="{{ URL::asset('js/admindashboard.js') }}"></script>
@endsection
