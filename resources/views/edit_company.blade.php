@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Companies') }}</h1>
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
                  <h3 class="card-title">Edit Company</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="inputCompanyName">Company Name</label>
                      <input type="text" class="form-control @error('inputCompanyName') is-invalid @enderror" name="inputCompanyName" id="inputCompanyName" placeholder="Enter name" value="{{ $company->name}}">
                      @error('inputCompanyName')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                      <label for="inputCompanyEmail1">Email address</label>
                      <input type="email" class="form-control @error('inputCompanyEmail1') is-invalid @enderror" name="inputCompanyEmail1" id="inputCompanyEmail1" placeholder="Enter email" value="{{ $company->email }}">
                      @error('inputCompanyEmail1')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                      <label for="inputCompanyWebsite">Website</label>
                      <input type="password" class="form-control @error('inputCompanyWebsite') is-invalid @enderror" name="inputCompanyWebsite" id="inputCompanyWebsite" placeholder="web url" value="{{ $company->website }}">
                      @error('inputCompanyWebsite')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                      <label for="inputCompanyLogo">Logo</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" accept="image/*" class="custom-file-input @error('inputCompanyLogo') is-invalid @enderror" name="inputCompanyLogo" id="inputCompanyLogo" value="{{ $company->logo }}">
                          <label class="custom-file-label" for="inputCompanyLogo">Choose file</label>
                        </div>
                      </div>
                      @error('inputCompanyLogo')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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

