@include('stuff.layouts.header')
<div class="d-flex">
    @include('stuff.layouts.sidebar')
    @yield('content')
</div>
@include('stuff.layouts.footer')
