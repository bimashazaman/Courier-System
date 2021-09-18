@extends('Admin.layouts.master')

@section('content')

    <div>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div><a href="{{route('admin.branch.view')}}" class="btn btn-secondary"> back</a></div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0" id="heading"> Add Branch
                    </h5>
                </div>


                <form action="{{route('admin.branch.store')}}"  method="POST" id="company-form" enctype="multipart/form-data">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label> Branch Name</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Branch Name" name="branch_name" >
                                    </label>

                                    @error('branch_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label> Branch email</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Branch email" name="branch_email" >
                                    </label>

                                    @error('branch_email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label> Branch phone</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Branch phone" name="branch_phone" >
                                    </label>

                                    @error('branch_phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label> Branch Address</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Branch Address" name="branch_address" >
                                    </label>

                                    @error('branch_address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label> Branch city</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Branch city" name="branch_city" >
                                    </label>

                                    @error('branch_city')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label> Branch state</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Branch state" name="branch_state" >
                                    </label>

                                    @error('branch_state')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label> Branch pin</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Branch pin" name="branch_pin" >
                                    </label>

                                    @error('branch_pin')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label> Branch Country</label>
                                    <label>
                                        <input type= "text" class="form-control"  placeholder="Branch Country" name="branch_country" >
                                    </label>

                                    @error('branch_country')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status" style="text-transform: uppercase;"><strong>Status</strong></label>
                            <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="status" {{ old('status')=='on' ? 'checked' : '' }}>
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
@stop
