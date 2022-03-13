<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/storage/siteLogo/{{ $name->site_logo }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    {{-- fontawasome css 1 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    {{-- custom js 1 --}}
    <title>@yield('title')</title>
</head>

<body>
    @yield('body')
    {{-- google api --}}
    @yield('google')
    {{-- facebook api --}}
    @yield('facebook')
</body>
