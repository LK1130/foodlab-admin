@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Site Manage')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/adminLayout.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/commonAdmincss.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/siteManage.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="{{ URL::asset('js/siteManage.js') }}"></script>
@endsection
@section('body')
    {{-- Starts Header Buttons --}}
    <div class="col-md-10 ">
        <div class="mt-4">
            <a href="{{ url('adminLogin') }}" class="me-5"><button class="btn text-light btncust"
                    class="me-5">{{ __('messageZY.loginManage') }}</button></a>
            <a href="{{ url('coinrate') }}" class="me-5"><button class="btn text-light btncust"
                    class="me-5">{{ __('messageZY.coinRate') }}</button></a>
            <a href="{{ url('siteManage') }}" class="me-5"><button
                    class="btn text-light  active btncust">{{ __('messageZY.siteManager') }}</button></a>
        </div>
        {{-- Starts Table --}}
        <select class="form-select select" id="select" aria-label="Default select example">
            <option value="siteManage">{{ __('messageZY.siteManage') }}</option>
            <option value="app" selected>{{ __('messageZY.appManage') }}</option>
            <option value="news">{{ __('messageZY.newsmanage') }}</option>
        </select>
        <div id="app">
            <div class="tables">
                <div class="tablediv">
                    <h2>{{ __('messageZY.township') }}</h2>
                    <table class="table tableApp">
                        <tr class="tableHeader">
                            <th>{{ __('messageZY.number') }}</th>
                            <th>{{ __('messageZY.township') }}</th>
                            <th>{{ __('messageZY.deliveryprice') }}</th>
                            <th>{{ __('messageZY.note') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @php
                            $count = 1;
                        @endphp

                        @forelse ($townships as $township)
                            <tr class="tableChile">
                                <th class="tdBlack">{{ $count++ }}</td>
                                <td class="tdBlack">{{ $township->township_name }}</td>
                                <td class="tdBlack">{{ $township->delivery_price }}</td>
                                <td class="tdBlack">{{ $township->note }} </td>
                                <td><a href="{{ route('township.show', $township->id) }}">
                                        <button class="btn btn-outline-primary"><i
                                                class="bi bi-pencil-square fs-5"></i></button>
                                    </a></td>
                                <td>
                                    <form action="{{ route('township.destroy', $township->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger delete">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="tableChile">
                                <td>{{ __('messageZY.notownship') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                    </table>
                    <a href="{{ route('township.create') }}" class="ms-auto leftSide"><button
                            class="btn text-light  active btncust">{{ __('messageZY.add') }}</button></a>
                </div>
                <div class="tablediv">
                    <h2>{{ __('messageZY.payment') }}</h2>
                    <table class="table tableApp">
                        <tr class="tableHeader">
                            <th>{{ __('messageZY.number') }}</th>
                            <th>{{ __('messageZY.paymentname') }}</th>
                            <th>{{ __('messageZY.accountname') }}</th>
                            <th>{{ __('messageZY.note') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @php
                            $countpayment = 1;
                        @endphp
                        @forelse ($payments as $payment)
                            <tr class="tableChile">
                                <th class="tdBlack">{{ $countpayment++ }}</td>
                                <td class="tdBlack">{{ $payment->payment_name }}</td>
                                <td class="tdBlack">{{ $payment->account_name }}</td>
                                <td class="tdBlack">{{ $payment->note }} </td>
                                <td><a href="{{ route('payment.show', $payment->id) }}">
                                        <button class="btn btn-outline-primary"><i
                                                class="bi bi-pencil-square fs-5"></i></button>
                                    </a></td>
                                <td>
                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger delete">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="tableChile">
                                <td>{{ __('messageZY.nopayment') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse

                    </table>
                    <a href="{{ route('payment.create') }}" class="ms-auto payment "><button
                            class="btn text-light  active btncust">{{ __('messageZY.add') }}</button></a>
                </div>
                <div class="tablediv">
                    <h2>{{ __('messageZY.category') }}</h2>
                    <table class="table tableApp">
                        <tr class="tableHeader">
                            <th>{{ __('messageZY.number') }}</th>
                            <th>{{ __('messageZY.categoryname') }}</th>
                            <th>{{ __('messageZY.note') }}</th>

                            <th></th>
                            <th></th>
                        </tr>
                        @php
                            $countcategory = 1;
                        @endphp
                        @forelse ($categories as $category)
                            <tr class="tableChile">
                                <th class="tdBlack">{{ $countcategory++ }}</td>
                                <td class="tdBlack">{{ $category->category_name }}</td>
                                <td class="tdBlack">{{ $category->note }} </td>


                                <td><a href="{{ route('category.show', $category->id) }}">
                                        <button class="btn btn-outline-primary"><i
                                                class="bi bi-pencil-square fs-5"></i></button>
                                    </a></td>
                                <td>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger delete">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="tableChile">
                                <td>{{ __('messageZY.nocategory') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse

                    </table>
                    <a href="{{ route('category.create') }}" class="ms-auto  category"><button
                            class="btn text-light  active btncust">{{ __('messageZY.add') }}</button></a>
                </div>
                <div class="tablediv">
                    <h2>{{ __('messageZY.taste') }}</h2>
                    <table class="table tableApp">
                        <tr class="tableHeader w-100">
                            <th>{{ __('messageZY.number') }}</th>
                            <th></th>
                            <th>{{ __('messageZY.taste') }}</th>
                            <th>{{ __('messageZY.note') }}</th>
                            <th class="my-2"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @php
                            $counttaste = 1;
                        @endphp
                        @forelse ($tastes as $taste)
                            <tr class="tableChile">
                                <th class="tdBlack">{{ $counttaste++ }}</td>
                                <th></th>
                                <td class="tdBlack">{{ $taste->taste }}</td>
                                <td class="tdBlack">{{ $taste->note }} </td>
                                <td></td>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td><a href="{{ route('taste.show', $taste->id) }}">
                                        <button class="btn btn-outline-primary"><i
                                                class="bi bi-pencil-square fs-5"></i></button>
                                    </a></td>
                                <td></td>
                                <td>
                                    <form action="{{ route('taste.destroy', $taste->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger delete">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="tableChile">
                                <td>{{ __('messageZY.nocategory') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse

                    </table>
                    <a href="{{ route('taste.create') }}" class="ms-auto taste"><button
                            class="btn text-light  active btncust">{{ __('messageZY.add') }}</button></a>
                </div>
                <div class="tablediv">
                    <h2>{{ __('messageZY.suggest') }}</h2>
                    <table class="table tableApp">
                        <tr class="tableHeader">
                            <th>{{ __('messageZY.number') }}</th>
                            <th>{{ __('messageZY.suggest') }}</th>
                            <th>{{ __('messageZY.note') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @php
                            $countsuggest = 1;
                        @endphp
                        @forelse ($suggests as $suggest)
                            <tr class="tableChile">
                                <th class="tdBlack">{{ $countsuggest++ }}</td>
                                <td class="tdBlack">{{ $suggest->suggest_type }}</td>
                                <td class="tdBlack">{{ $suggest->note }} </td>
                                <td></td>
                                <td><a href="{{ route('suggestAdmin.show', $suggest->id) }}">
                                        <button class="btn btn-outline-primary"><i
                                                class="bi bi-pencil-square fs-5"></i></button>
                                    </a></td>
                                <td>
                                    <form action="{{ route('suggestAdmin.destroy', $suggest->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger delete">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="tableChile">
                                <td>{{ __('messageZY.nosuggest') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse

                    </table>
                    <a href="{{ route('suggestAdmin.create') }}" class="ms-auto suggest"><button
                            class="btn text-light active btncust">{{ __('messageZY.add') }}</button></a>
                </div>
                <div class="tablediv">
                    <h2>{{ __('messageZY.favfood') }}</h2>
                    <table class="table tableApp">
                        <tr class="tableHeader">
                            <th>{{ __('messageZY.number') }}</th>
                            <th>{{ __('messageZY.favfood') }}</th>
                            <th>{{ __('messageZY.note') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @php
                            $countfav = 1;
                        @endphp
                        @forelse ($favtypes as $favtype)
                            <tr class="tableChile">
                                <th class="tdBlack">{{ $countfav++ }}</td>
                                <td class="tdBlack">{{ $favtype->favourite_food }}</td>
                                <td class="tdBlack">{{ $favtype->note }} </td>
                                <td></td>
                                <td><a href="{{ route('favtype.show', $favtype->id) }}">
                                        <button class="btn btn-outline-primary"><i
                                                class="bi bi-pencil-square fs-5"></i></button>
                                    </a></td>
                                <td>
                                    <form action="{{ route('favtype.destroy', $favtype->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger delete">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="tableChile">
                                <td>{{ __('messageZY.nofav') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse

                    </table>
                    <a href="{{ route('favtype.create') }}" class="ms-auto favtype"><button
                            class="btn text-light  active btncust">{{ __('messageZY.add') }}</button></a>
                </div>
                <div class="tablediv">
                    <h2>{{ __('messageZY.orderstatus') }}</h2>
                    <table class="table tableApp">
                        <tr class="tableHeader">
                            <th>{{ __('messageZY.number') }}</th>
                            <th>{{ __('messageZY.status') }}</th>
                            <th>{{ __('messageZY.note') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                        @php
                            $countorder = 1;
                        @endphp
                        @forelse ($orderstatus as $orderstatusa)
                            <tr class="tableChile">
                                <th class="tdBlack">{{ $countorder++ }}</td>
                                <td class="tdBlack">{{ $orderstatusa->status }}</td>
                                <td class="tdBlack">{{ $orderstatusa->note }} </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="{{ route('orderstatus.show', $orderstatusa->id) }}">
                                        <button class="btn btn-outline-primary"><i
                                                class="bi bi-pencil-square fs-5"></i></button>
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr class="tableChile">
                                <td>{{ __('messageZY.noorder') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse

                    </table>
                    <a href="{{ route('orderstatus.create') }}" class="ms-auto orderstatus"><button
                            class="btn text-light  active btncust">{{ __('messageZY.add') }}</button></a>
                </div>
                <div class="tablediv">
                    <h2>{{ __('messageZY.decision') }} </h2>
                    <table class="table tableApp">
                        <tr class="tableHeader">
                            <th>{{ __('messageZY.number') }}</th>
                            <th>{{ __('messageZY.decision') }}</th>
                            <th>{{ __('messageZY.note') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                        @php
                            $countdecision = 1;
                        @endphp
                        @forelse ($decisions as $decision)
                            <tr class="tableChile">
                                <th class="tdBlack">{{ $countdecision++ }}</td>
                                <td class="tdBlack">{{ $decision->status }}</td>
                                <td class="tdBlack">{{ $decision->note }} </td>
                                <td></td>
                                <td></td>
                                <td><a href="{{ route('decision.show', $decision->id) }}">
                                        <button class="btn btn-outline-primary"><i
                                                class="bi bi-pencil-square fs-5"></i></button>
                                    </a></td>

                            </tr>
                        @empty
                            <tr class="tableChile">
                                <td>{{ __('messageZY.nodecision') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse

                    </table>
                    <a href="{{ route('decision.create') }}" class="ms-auto decision"><button
                            class="btn text-light active btncust">{{ __('messageZY.add') }}</button></a>
                </div>
            </div>

        </div>
    </div>
@endsection
