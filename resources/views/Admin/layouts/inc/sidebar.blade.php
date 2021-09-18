<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li class="active"><a href=""><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</a></li>


        <li><a href="{{ route('admin.company.view') }}"><i class="fa fa-cog"></i> Company Management</a></li>

                <li><a href="{{ route('admin.basicSetting') }}"><i class="fa fa-cog"></i> Basic Settings</a></li>
                <li><a href="{{ route('admin.smsSetting') }}"><i class="fa fa-phone"></i> SMS Settings</a></li>
                <li><a href="{{ route('admin.emailSetting') }}"><i class="fa fa-envelope"></i> Email Settings</a></li>




                <li><a href="{{ route('admin.unit.index') }}"><i class="far fa-circle"></i>&nbsp;Manage Unit</a></li>
                <li><a href="{{ route('admin.courier.index') }}"><i class="far fa-circle"></i>&nbsp;Manage Type</a></li>




                <li><a href="{{ route('admin.branch.create') }}"><i class="far fa-circle"></i> Add New Branch</a></li>
                <li><a href="{{ route('admin.branch.view') }}"><i class="far fa-circle"></i> Manage Branch</a></li>



                <li><a href="{{route('admin.manager.create')}}"><i class="far fa-circle"></i> Add Manager</a></li>
                <li><a href="{{route('admin.manager.index')}}"><i class="far fa-circle"></i> Manage Manager</a></li>



                <li><a href="{{ route('admin.frontend.logoicon') }}"><i class="far fa-circle"></i>&nbsp;Logo+icon</a></li>
                <li><a href="{{ route('admin.frontend.social') }}"><i class="far fa-circle"></i>&nbsp;Social Link</a></li>
                <li><a href="{{ route('admin.frontend.background') }}"><i class="far fa-circle"></i>&nbsp;Background Image</a></li>
                <li><a href="{{ route('admin.frontend.headertextsetting') }}"><i class="far fa-circle"></i> Banner Text</a></li>
                <li><a href="{{ route('admin.frontend.couriercount') }}"><i class="far fa-circle"></i> Courier Count Info</a></li>
                <li><a href="{{ route('admin.frontend.services') }}"><i class="far fa-circle"></i> Service Setting</a></li>
                <li><a href="{{ route('admin.frontend.aboutus') }}"><i class="far fa-circle"></i> About Us</a></li>
                <li><a href="{{ route('admin.frontend.contactus') }}"><i class="far fa-circle"></i> Contact</a></li>
                <li><a href="{{ route('admin.frontend.testimonial') }}"><i class="far fa-circle"></i> Testimonial</a></li>
                <li><a href="{{ route('admin.frontend.searchcourier') }}"><i class="far fa-circle"></i> Search Courier</a></li>
                <li><a href="{{ route('admin.frontend.footer') }}"><i class="far fa-circle"></i> Footer</a></li>
                <li><a href="{{ route('admin.frontend.faq') }}"><i class="far fa-circle"></i> Faq</a></li>
        <li id="visitorMessage"><a href="{{ route('admin.frontend.showVisitorMessage') }}"><i class="fa fa-fw fa-tachometer-alt"></i> Visitor Message</a></li>
</div>
