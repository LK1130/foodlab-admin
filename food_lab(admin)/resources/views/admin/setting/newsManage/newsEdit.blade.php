@extends('COMMON.layout.layout_admin')
@section('title', 'Admin | News Edit')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/adminLayout.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/commonAdmincss.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/adminAdd.css') }}" />
@endsection

@section('script')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/newsAdd.js') }}"></script>
@endsection
@section('body')
    {{-- Starts Header Buttons --}}
    <div class="col-md-10 ">
        <div class="mt-4">
            <a href="{{ url('news') }}"><button
                    class="btn text-light addAdminButton active btncust ">{{ __('messageZY.back') }}</button></a>
        </div>
        {{-- Starts Form --}}
        <div class="adminAddForm">
            <form action="{{ route('news.update', $news->newsid) }}" method="POST">
                @csrf
                @method('PUT')
                <p class="formHeader">{{ __('messageZY.editnews') }} </p>
                <div>
                    <div class="form-group mt-3">
                        <label for="title">{{ __('messageZY.title') }}</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}">
                        @error('title')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="imgshow">
                        <p>{{ __('messageZY.chosenimage') }}</p>
                        <img src="/storage/newsImage/{{ $news->source }}" alt="">
                    </div>
                    <div class="form-group mt-3 column">
                        <label for="note">{{ __('messageZY.category') }}</label>
                        <select id="category" class="selectcategory form-control">
                            @forelse ($categories as $category)
                                @if ($news->category == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->category_name }}
                                    </option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endif

                            @empty
                                <option>{{ __('messageZY.nocategory') }} .</option>
                            @endforelse
                        </select>
                        <input type="number" id="idhide" name="category" value="{{ $category->id }}">
                        @error('category')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="detail">{{ __('messageZY.detail') }}</label>
                        <input type="text" class="form-control" id="detail" name="detail" value="{{ $news->detail }}">
                        @error('detail')
                            <li class="text-danger ">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group ml-5">
                        <button type="submit"
                            class="btn text-light addAdminButton active btncust m-4">{{ __('messageZY.save') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
