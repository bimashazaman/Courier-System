@extends('Admin.layouts.master')

@section('content')

    <div class=" p-4">
        <h2 class="mb-4 p-3" style="text-transform: uppercase;" >All Units

            <a href="{{route('admin.unit.create')}}" class="btn btn-primary ml-3 p-2 btn-md float-right" >
                <i class="fa fa-list"></i>   Add Unit
            </a>

        </h2>
    </div>



    <div class="card-body p-4 just shadow-lg  border-gray-300" style="width: 100%">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($unitList as $unit)
                    <tr>
                        <td>{{ $unit->name }}</td>
                        <td>
                            @if($unit->status  == 'Active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.unit.edit', $unit->id) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> EDIT</button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>

@stop
