@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | Admin List')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/adminLayout.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/commonAdmincss.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/adminList.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel=”stylesheet” href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="{{ URL::asset('js/adminList.js') }}"></script>
@endsection
@section('body')
    <div class="col-md-10">
        {{-- Starts Header Buttons --}}
        <div class="mt-4">
            <a href="{{ url('adminLogin') }}" class="me-5"><button
                    class="btn text-light  active btncust">{{ __('messageZY.loginManage') }}</button></a>
            <a href="{{ url('coinrate') }}" class="me-5"><button
                    class="btn text-light   btncust">{{ __('messageZY.coinRate') }}</button></a>
            <a href="{{ url('siteManage') }}" class="me-5"><button
                    class="btn text-light   btncust">{{ __('messageZY.siteManager') }}</button></a>
        </div>
        {{-- Starts Table --}}
        <table class="table mt-5">
            <tr class="tableHeader">
                <td>{{ __('messageZY.number') }}</td>
                <td>{{ __('messageZY.username') }}</td>
                <td>{{ __('messageZY.validation') }}</td>
                <td>{{ __('messageZY.role') }}</td>
                <th></th>
                <th></th>

            </tr>
            @php
                $count = 1;
                $valid = '';
            @endphp
            @forelse ($admins as $admin)
                @if ($admin->ad_valid == '0')
                    @php
                        $valid = 'No';
                    @endphp
                @else
                    @php
                        $valid = 'Yes';
                    @endphp
                @endif
                <tr class="tableChile">

                    <th class="tdBlack">{{ $count++ }}</td>
                    <td class="tdBlack">{{ $admin->ad_name }}</td>
                    <td class="tdBlack ">{{ $valid }}
                    </td>
                    <td class="tdBlack">{{ $admin->ad_role }} </td>

                    <td><a href="{{ route('adminLogin.edit', $admin->id) }}">
                            <button class="btn btn-outline-primary"><i class="bi bi-pencil-square fs-5"></i></button>
                        </a></td>
                    <td>
                        <form action="{{ route('adminLogin.destroy', $admin->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger delete">
                                <ion-icon name="trash-outline" class="fs-4 text-danger "></ion-icon>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <td>{{ __('messageZY.noadmin') }} .</td>

            @endforelse
        </table>
        <div class="d-flex justify-content-center ">{{ $admins->links() }}</div>

        <a href="{{ route('adminLogin.create') }}" class="addAdminButton "><button
                class="btn text-light  active btncust">{{ __('messageZY.addAdmin') }}</button></a>
    </div>

@endsection
