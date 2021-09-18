@include('Admin.layouts.inc.header')
<div class="d-flex">
    @include('Admin.layouts.inc.sidebar')
    @yield('content')
</div>
@include('Admin.layouts.inc.footer')
