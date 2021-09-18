@extends('Admin.layouts.master')
@section('content')

    <div class=" p-4">
        <h2 class="mb-4 p-3" style="text-transform: uppercase;" >All Branches

            <a href="{{route('admin.branch.create')}}" class="btn btn-primary ml-3 p-2 btn-md float-right" >
                <i class="fa fa-list"></i>   Add Branch
            </a>

        </h2>
    </div>




        <div class="card-body p-4 just shadow-lg  border-gray-300" style="width: 100%">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>city</th>
                        <th>state</th>
                        <th>pin</th>
                        <th>country</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($branches as $branch)

                    <tr>
                        <td>{{ $branch->branch_name }}</td>
                        <td>{{ $branch->branch_email }}</td>
                        <td>{{ $branch->branch_phone }}</td>
                        <td>{{ $branch->branch_address }}</td>
                        <td>{{ $branch->branch_city }}</td>
                        <td>{{ $branch->branch_state }}</td>
                        <td>{{ $branch->branch_pin }}</td>
                        <td>{{ $branch->branch_country }}</td>
                        <td>
                            @if($branch->status  == 'Active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.branch.update',$branch->id)}}" class="btn btn-outline-primary-sm">Update</a>


                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>









@stop
