<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{adminAsset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{adminAsset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{adminAsset('dist/css/adminlte.min.css')}}">
</head>
<body class="bg-info">
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="manager-logo">
{{--                <a  href="{{ route('front.index') }}">--}}
{{--                    <img src="{{asset('assets/frontend/images/logo.png')}}" alt="*" style="width:100%;">--}}
{{--                </a>--}}
            </div>
            <div class="card border border-success">
                <div class="card-header  text-white text-uppercase h4" style="background: #173C5A;">Branch Manager Login Form</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Username" value="manager">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" value="manager">
                            <input type="hidden" name="type" value="Manager" class="form-control">
                            <input type="hidden" name="status" value="Active" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col pr-2">
                                <button type="submit" class="btn btn-block text-uppercase h4 font-weight-bold" style="background: #173C5A; color:#fff;">Login</button>
                            </div>
                        </div>
                        <div class="row">
                            <a class="btn btn-link" href="" style="font-size:16px; color: #173C5A; font-weight: 600;">
                                Forgot your password ?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{adminAsset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{adminAsset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{adminAsset('dist/js/adminlte.min.js')}}"></script>


</body>
</html>