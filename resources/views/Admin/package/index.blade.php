@extends('Admin.layouts.master')
@section('content')

    <div class=" p-4">
        <h2 class="mb-4 p-3" style="text-transform: uppercase;" >All Packages

            <a href="{{route('admin.package.create')}}" class="btn btn-primary ml-3 p-2 btn-md float-right" >
                <i class="fa fa-list"></i>   Add package
            </a>

        </h2>
    </div>



    <div class="card-body p-4 just shadow-lg  border-gray-300" style="width: 100%">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Base price</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($package as $package)

                    <tr>
                        <td>{{ $package->name }}</td>
                        <td>$ {{ $package->base_price }}</td>
                        <td>$ {{ $package->tax }}</td>
                        <td>$ {{ $package->total_price }}</td>

                        <td>
                            <a href="{{route('admin.package.updateView', $package->id)}}" class="btn btn-outline-primary-sm">Update</a>
                            <a href="{{route('admin.package.delete', $package->id)}}" class="btn btn-outline-danger-sm">delete</a>


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>









@stop
