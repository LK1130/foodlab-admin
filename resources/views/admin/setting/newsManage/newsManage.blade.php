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
            <a href="{{ url('adminLogin') }}" class="me-5"><button
                    class="btn text-light   btncust">{{ __('messageZY.loginManage') }}</button></a>
            <a href="{{ url('coinrate') }}" class="me-5"><button
                    class="btn text-light   btncust">{{ __('messageZY.coinRate') }}</button></a>
            <a href="{{ url('siteManage') }}" class="me-5"><button
                    class="btn text-light  active btncust">{{ __('messageZY.siteManager') }}</button></a>
        </div>
        {{-- Starts Table --}}
        <select class="form-select select" id="select" aria-label="Default select example">
            <option value="siteManage">{{ __('messageZY.siteManage') }}</option>
            <option value="app">{{ __('messageZY.appManage') }}</option>
            <option value="news" selected>{{ __('messageZY.newsmanage') }}</option>
        </select>
        <div id="news">
            <table class="table table2  newstable">

                <tr class="tableHeader ">
                    <td>{{ __('messageZY.number') }}</td>
                    <td>{{ __('messageZY.title') }}</td>
                    <td>{{ __('messageZY.news') }}</td>
                    <td>{{ __('messageZY.category') }}</td>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @php
                    $countnews = 1;
                @endphp
                @forelse ($news as $new)
                    <tr class="tableChile">
                        <th class="tdBlack">{{ $countnews++ }}</th>
                        <td class="tdBlack">{{ $new->title }}</td>
                        <td class="tdBlack">{{ $new->detail }}</td>
                        <td class="tdBlack">{{ $new->category_name }}</td>
                        <td><input type="checkbox" class=""></td>
                        <td><a href="{{ route('news.show', $new->newsid) }}">
                                <button class="btn btn-outline-primary"><i class="bi bi-pencil-square fs-5"></i></button>
                            </a></td>
                        <td>
                            <form action="{{ route('news.destroy', $new->newsid) }}" method="POST">
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
                {{-- <div class="newsbutton1"><a href="{{ route('news.create') }}"><button
                            class="btn text-light addAdminButton active btncust mt-5">{{ __('messageZY.add') }}</button></a>
                </div> --}}

            </table>
            <div class=" d-flex mt-3  justify-content-center">{{ $news->links() }}</div>
            <a href="{{ route('news.create') }}" class="addAdminButton "><button
                    class="btn text-light  active btncust">{{ __('messageZY.addnews') }}</button></a>
        </div>
    </div>
@endsection
