@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Employees') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-7">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Employees</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('employee.store') }}">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="inputEmployeeFirstName">First Name</label>
                      <input type="text" class="form-control @error('inputEmployeeFirstName') is-invalid @enderror" name="inputEmployeeFirstName" id="inputEmployeeFirstName" placeholder="Enter first name" value="{{ old('inputEmployeeFirstName') }}">
                      @error('inputEmployeeFirstName')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                      <label for="inputEmployeeLastName">Last Name</label>
                      <input type="text" class="form-control @error('inputEmployeeLastName') is-invalid @enderror" name="inputEmployeeLastName" id="inputEmployeeLastName" placeholder="Enter last name" value="{{ old('inputEmployeeLastName') }}">
                      @error('inputEmployeeLastName')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                      <label for="inputEmployeeEmail1">Email address</label>
                      <input type="email" class="form-control @error('inputEmployeeEmail1') is-invalid @enderror" name="inputEmployeeEmail1" id="inputEmployeeEmail1" placeholder="Enter email" value="{{ old('inputEmployeeEmail1') }}">
                      @error('inputEmployeeEmail1')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                      <label for="inputEmployeePhone">Phone Number</label>
                      <input type="number" class="form-control @error('inputEmployeePhone') is-invalid @enderror" name="inputEmployeePhone" id="inputEmployeePhone" placeholder="Enter phone number" value="{{ old('inputEmployeePhone') }}">
                      @error('inputEmployeePhone')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="inputEmployeeCompany">Company</label>
                        <select class="form-control" name="inputEmployeeCompany" required>
                        <option disabled selected>Choose...</option>
                        @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                        </select>
                        @error('inputEmployeeCompany')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection