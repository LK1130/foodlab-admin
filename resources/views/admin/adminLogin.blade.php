<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ url('img/logo.png') }}">
    <title>Food Lab</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/adminLogin.css') }}" />
    <link rel="stylesheet" href="{{ url('css/commonAdmincss.css') }}" />
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    {{--  Start Login Section   --}}
    <section>
        <div class="d-flex flex-column justify-content-center align-items-center fw-bolder logins">   
            <p class="fs-1">{{ __('messageMK.adminLogin') }}</p>
            <form action="/admin" method="POST" class="forms">
                @csrf
                <div class="mb-3">
                    <label for="username" class="fs-5">{{ __('messageMK.Username') }}</label>
                    <div class="inputs">
                        <i class="fas fa-user-alt"></i>
                        <input type="text" class="form-control" id="username" name="username" autocomplete="off"/>
                    </div>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div  class="mb-4">
                    <label for="password" class="fs-5">{{ __('messageMK.Password') }}</label>
                    <div class="inputs">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off"/>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <input type="submit" class="form-control" value="{{ __("messageMK.login") }}"/>
            
            </form>
        </div>
    </section>
    {{--  End Login Section   --}}
</body>
</html>