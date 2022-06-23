<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('login/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href=" {{asset('login/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" {{asset('bootstrap-4.6.1-rtl/css/bootstrap.css')}}">
    <link rel="stylesheet" href=" {{asset('bootstrap-4.6.1-rtl/css/bootstrap-rtl.css')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{asset('login/css/style.rtl.css')}}">

    <title>Taiba Agent login </title>
    <style>
        body{
            direction: rtl !important;
        }
    </style>
</head>
<body dir="rtl" direction="rtl">


<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('/login/images/bg_5.jpg');"></div>
    <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3>تسجيل الدخول   <strong> مندوب الشركة  </strong></h3>
                    <p class="mb-4"></p>
                    <form action="{{ route('agent.login') }}" aria-label="{{ __('Login') }}" method="post" dir="rtl">
                        @csrf
                        <div class="form-group first">
                            <label for="username">البريد الالكتروني</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"  placeholder="البريد الالكتروني" id="email" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus
                            >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group last mb-3">
                            <label for="password">كلمة المرور</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمة المرور" id="password" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="d-flex mb-5 align-items-center">
                            <label class="control control--checkbox mb-0"><span class="caption">تذكرني</span>
                                <input type="checkbox" checked="checked"  name="remember" {{ old('remember') ? 'checked' : '' }}/>
                                <div class="control__indicator"></div>
                            </label>

                            {{--                            @if (Route::has('admin.password.request'))--}}


                            {{--                                <span class="ml-auto">--}}
                            {{--                                    <a href="{{ route('admin.password.request')}}"--}}
                            {{--                                                         class="forgot-pass">--}}
                            {{--                                        {{ __('Forgot Your Password?') }}--}}
                            {{--                                    </a>--}}
                            {{--                                </span>--}}

                            {{--                            @endif--}}

                        </div>

                        <input type="submit" value="تسجيل الدخول" class="btn btn-block btn-primary">

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>



<script src=" {{asset('login/js/jquery-3.3.1.min.js')}}"></script>
<script src=" {{asset('login/js/popper.min.js')}}"></script>
<script src=" {{asset('login/js/bootstrap.min.js')}}"></script>
<script src="  {{asset('login/js/main.js')}}"></script>
</body>
</html>
