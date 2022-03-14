@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | Customer Info
@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/admincustomerInfo.css') }}">
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection


@section('body')
    @if (session('role') == 'SA')
        <div class="col-md-10">
            <div class="status text title fw-bold mb-4 mt-4">{{ __('messageZN.Customer Info') }}</div>
            <form action="">
                <div class="d-flex">
                    <input type="text" class="form-control cusinput border border-dark fs-4" id="search" required>
                    <span class="mx-3"><button class="btn bybtns text-light btnstext" id="searchname">By
                            Nickname</button></span>
                    <span><button class="btn bybtns text-light btnstext" id="searchid">By ID</button></span>
                </div>
            </form>
            <div class="row mt-4">
                <div class="col-md-12 roow">
                    <table class="table boxshad ">
                        <thead>
                            <tr class="tableheader tablerows">
                                <th scope="col">{{ __('messageZN.No') }}</th>
                                <th scope="col">{{ __('messageZN.Nickname') }}</th>
                                <th scope="col">{{ __('messageZN.Customer ID') }}</th>
                                <th scope="col">{{ __('messageZN.Phoneno') }}</th>
                                <th scope="col">{{ __('messageZN.Address') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="searchlist">
                            @forelse ($t_cu_customer as $key => $list1)
                                <tr class="tablecolor1 tablerows orglist" id="orglist">
                                    <th scope="row">{{ $t_cu_customer->firstItem() + $key }}</th>
                                    <td>{{ $list1->nickname }}</td>
                                    <td>{{ $list1->customerID }}</td>
                                    <td>{{ $list1->phone }}</td>
                                    <td>{{ $list1->state_name }} {{ $list1->township_name }} {{ $list1->address3 }}
                                    </td>
                                    <td>
                                        <a href="customerinfoDetail?id={{ $list1->id }}">
                                            <button class="btn tablerows btn-outline-dark"><i
                                                    class="bi bi-arrow-right"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">There is no Data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">{{ $t_cu_customer->links() }}</div>
                </div>
            </div>
        </div>
        {{-- For AD And Other --}}
    @else
        <div class="col-md-10">
            <div class="status text title fw-bold mb-4 mt-4">{{ __('messageZN.Customer Info') }}</div>
            <form action="">
                <div class="d-flex">
                    <input type="text" class="form-control cusinput border border-dark" id="search" required>
                    <span class="mx-3"><button class="btn bybtns text-light btnstext" id="searchname">By
                            Nickname</button></span>
                    <span><button class="btn bybtns text-light btnstext" id="searchid">By ID</button></span>
                </div>
            </form>
            <div class="row mt-4">
                <div class="col-md-12 roow">
                    <table class="table boxshad ">
                        <thead>
                            <tr class="tableheader tablerows">
                                <th scope="col">{{ __('messageZN.No') }}</th>
                                <th scope="col">{{ __('messageZN.Nickname') }}</th>
                                <th scope="col">{{ __('messageZN.Customer ID') }}</th>
                                <th scope="col">{{ __('messageZN.Phoneno') }}</th>
                                <th scope="col">{{ __('messageZN.Address') }}</th>
                            </tr>
                        </thead>
                        <tbody class="searchlist">
                            @forelse ($t_cu_customer as $key => $list1)
                                <tr class="tablecolor1 tablerows orglist" id="orglist">
                                    <th scope="row">{{ $t_cu_customer->firstItem() + $key }}</th>
                                    <td>{{ $list1->nickname }}</td>
                                    <td>{{ $list1->customerID }}</td>
                                    <td>{{ $list1->phone }}</td>
                                    <td>{{ $list1->state_name }} {{ $list1->township_name }} {{ $list1->address3 }}
                                    </td>
                                </tr>
                            @empty
                                There is no Data.
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">{{ $t_cu_customer->links() }}</div>
                </div>
            </div>
        </div>
    @endif
    <script>
        var role = @json(session('role'));
        console.log(role);
    </script>
    <script src="{{ URL::asset('js/customerInfo.js') }}"></script>
@endsection
