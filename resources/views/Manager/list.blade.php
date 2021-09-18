@extends('Admin.layouts.master')
@section('content')

    <div class=" p-4">
        <h2 class="mb-4 p-3" style="text-transform: uppercase;" >All Managers

            <a href="{{route('admin.manager.create')}}" class="btn btn-primary ml-3 p-2 btn-md float-right" >
                <i class="fa fa-list"></i>   Add Managers
            </a>

        </h2>
    </div>




    <div class="card-body p-4 just shadow-lg  border-gray-300" style="width: 100%">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                <tr>

                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Branch</th>
                    <th>Status</th>



                </tr>
                </thead>
                <tbody>
                @foreach($branchManagerList as $key=>$branchManagerList)

                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $branchManagerList->name }}</td>
                        <td>{{ $branchManagerList->email }}</td>
                        <td>{{ $branchManagerList->email }}</td>
                        <td>{{ $branchManagerList->phone }}</td>
                        <td>{{ $branchManagerList->branch_name }}</td>
                        <td>
                            @if($branchManagerList->status  == 'Active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>









@stop
