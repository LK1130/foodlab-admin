@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | Customer Suggest
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/adminDashbord.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/adminnoties.css') }}">
@endsection

@section('script')
@endsection
@section('body')
    <div class="col-md-10">
        {{-- Top Noti Start --}}
        <div class="d-flex mt-4">
            <div>
                <a href="dashboard"><button class="btn btncust1 text-light">{{ __('messageZN.Back') }}</button></a>
            </div>
            <div class="notification">
                {{-- Suggest --}}
                <a href="customerSuggest ">
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

        </div>
        {{-- Top Noti End --}}

        <div class="status text title fw-bold mb-4">{{ __('messageZN.cussug') }}</div>
        <div class="row">
            <div class="col-md-12">
                <table class="table boxshad me-5">
                    <thead>
                        <tr class="tableheader tablerows">
                            <th scope="col">{{ __('messageZN.No') }}</th>
                            <th scope="col">{{ __('messageZN.Customer ID') }}</th>
                            <th scope="col">{{ __('messageZN.sugtype') }}</th>
                            <th scope="col">{{ __('messageZN.message') }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suggest as $key => $sug)
                            <tr class="tablecolor1  tablerows">
                                <th scope="row">{{ $suggest->firstItem() + $key }}</th>
                                <td>{{ $sug->customerID }}</td>
                                <td>{{ $sug->suggest_type }}</td>
                                <td>{{ $sug->message }}</td>
                                <td>
                                    @if ($sug->reply == null)
                                        <a href="suggestreplies?id={{ $sug->ID }}">
                                            <button class="btn btn-primary">{{ __('messageZN.reply') }}</button></a>
                                </td>
                            @else
                                {{ __('messageZN.done') }}
                        @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">There is no Data.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{ $suggest->links() }}</div>
            </div>
        </div>
    </div>
@endsection
