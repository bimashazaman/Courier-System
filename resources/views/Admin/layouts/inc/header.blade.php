<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{  asset('assets/frontend/images/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/morris.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootadmin.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-toggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap-toggle.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/datatables.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset('assets/admin/js/morris.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/raphael.min.js')}}"></script>
{{--    @php--}}
{{--        $gs = App\Model\GeneralSetting::first();--}}
{{--    @endphp--}}
{{--    <title>{{ $gs->title }}</title>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark bg-custom-background">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="#">Admin Panel</a>

   <div>
       <form method="POST" action="{{ route('logout') }}">
           @csrf
           <li>
               <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                   {{ __('Log Out') }}
               </a>
           </li>
       </form>
   </div>
</nav>
