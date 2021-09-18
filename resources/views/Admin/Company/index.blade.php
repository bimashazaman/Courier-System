@extends('Admin.layouts.master')
@section('content')


    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0" id="heading">
                    @if(count($companies) > 0)
                        Edit Company
                    @else
                        Add new company
                    @endif

                </h5>
            </div>
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Company Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
{{--                    action="{{route('admin.company.store')}}"--}}
                    <form  method="POST" id="company-form" enctype="multipart/form-data">
                        @if(count($companies) > 0)
                            @method('put')
                        @endif

                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label> Company Name</label>
                                <label>
                                    <input type= "text" class="form-control"  placeholder="Company Name" name="company_name"
                                    @if(count($companies) > 0)
                                        value="{{$company->company_name}}"
                                        @endif
                                    >
                                </label>

                                @error('company_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label> Company address</label>
                                <label>
                                    <input type= "text" class="form-control"  placeholder=" Address" name="company_address"
                                           @if(count($companies) > 0)
                                           value="{{$company->company_address}}"
                                        @endif
                                    >
                                </label>

                                @error('company_address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label> city</label>
                                <label>
                                    <input type= "text" class="form-control"  placeholder=" City" name="company_city"
                                           @if(count($companies) > 0)
                                           value="{{$company->company_city}}"
                                        @endif
                                    >
                                </label>

                                @error('company_city')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>


                            <div class="form-group">
                                <label> state</label>
                                <label>
                                    <input type= "text" class="form-control"  placeholder="State" name="company_state"
                                           @if(count($companies) > 0)
                                           value="{{$company->company_state}}"
                                        @endif
                                    >
                                </label>
                                @error('company_state')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label> Company pin</label>
                                <label>
                                    <input type= "text" class="form-control"  placeholder="Company Pin" name="company_pin"
                                           @if(count($companies) > 0)
                                           value="{{$company->company_pin}}"
                                        @endif
                                    >
                                </label>

                                @error('company_pin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label> Country</label>
                                <label>
                                    <input type= "text" class="form-control"  placeholder="Country" name="company_country"
                                           @if(count($companies) > 0)
                                           value="{{$company->company_country}}"
                                        @endif
                                    >
                                </label>

                                @error('company_country')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label> Phone</label>
                                <label>
                                    <input type= "text" class="form-control"  placeholder="Phone" name="company_phone"
                                           @if(count($companies) > 0)
                                           value="{{$company->company_phone}}"
                                        @endif
                                    >
                                </label>

                                @error('company_phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label> Email</label>
                                <label>
                                    <input type= "email" class="form-control"  placeholder="email" name="company_email"
                                           @if(count($companies) > 0)
                                           value="{{$company->company_email}}"
                                        @endif
                                    >
                                </label>
                                @error('company_email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label> GST</label>
                                <label>
                                    <input type= "text" class="form-control"  placeholder="GST" name="company_gst"
                                           @if(count($companies) > 0)
                                           value="{{$company->company_gst}}"
                                        @endif
                                    >
                                </label>
                                @error('company_gst')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label> company logo</label>
                                <input type= "file" class="form-control"  placeholder="logo" name="company_logo">

                                @error('company_logo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button onclick="companyFormSubmit()" class="btn btn-primary" value="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <h2 class="mb-4" style="text-transform: uppercase;">Company

    </h2>
    <div class="card-body p-4 just shadow-lg  border-gray-300" style="width: 100%">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>address</th>
                    <th>city</th>
                    <th>state</th>
                    <th>pin</th>
                    <th>country</th>
                    <th>phone</th>
                    <th>email</th>
                    <th>gst</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)

                    <tr>
                        <td>{{$company->company_name}}</td>
                        <td>{{$company->company_address}}</td>
                        <td>{{$company->company_city}}</td>
                        <td>{{$company->company_state}}</td>
                        <td>{{$company->company_pin}}</td>
                        <td>{{$company->company_country}}</td>
                        <td>{{$company->company_phone}}</td>
                        <td>{{$company->company_email}}</td>
                        <td>{{$company->company_gst}}</td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>

@stop

<script>
    function companyFormSubmit()
    {
        var heading = $('#heading').val()
        if (heading == 'Add new company')
        {
            $('#company-form').attr('action' ,'{{route('admin.company.store')}}').submit();
        }
        else
        {
            $('#company-form').attr('action' ,'{{route('admin.company.update')}}').submit();
        }
    }
</script>

