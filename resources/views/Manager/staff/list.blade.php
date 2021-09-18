@extends('Manager.layouts.master')
@section('content')

    <div class="content p-4">
        <h2 class="mb-4" style="text-transform: uppercase;">All Branch Staff
            <a href="{{ route('manager.create') }}" class="btn btn-primary btn-md float-right">
                <i class="fa fa-list"></i>   Add Branch Staff
            </a>
        </h2>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12  mb-2">
                        <form method="GET" action="{{ route('manager.index') }}" class="form-inline float-right">
                            @csrf
                            <div class="form-group">
                                &nbsp;<input type="text" class="form-control" name="search" placeholder="search" value="{{request()->search}}">
                            </div>&nbsp;
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search</button>
                        </form>
                    </div>
                </div>
                <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
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
                    @forelse($branchStaffList as $key=>$branchStaffList)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $branchStaffList->name }}</td>
                            <td>{{ $branchStaffList->email }}</td>
                            <td>{{ $branchStaffList->phone }}</td>
                            <td>{{ $branchStaffList->branch->name }}</td>
                            <td>
                                @if($branchStaffList->status  == 'Active')
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No Information</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#branchStaff").addClass("show");
        $("#branchStaff li:nth-child(2)").addClass("active");
    </script>



@stop
