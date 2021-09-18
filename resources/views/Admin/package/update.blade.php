@extends('Admin.layouts.master')

@section('content')

    <div>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div><a href="{{route('admin.package.index')}}" class="btn btn-secondary"> back</a></div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0" id="heading">update package
                    </h5>
                </div>


                <form action="{{route('admin.package.update', $package->id)}}"  method="post" id="company-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder=" Name" name="name" >
                                    </label>

                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Base price</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="base price" name="base_price" >
                                    </label>

                                    @error('base_price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Tax</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Tax" name="tax" >
                                    </label>

                                    @error('tax')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Total Price</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Total price" name="total_price" >
                                    </label>

                                    @error('total_price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" value="submit">Submit</button>
                            </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    </div>

    </div>
@stop
