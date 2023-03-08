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
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif 
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employees List</h3>
                        <a href="{{ route('employee.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Company</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th style="width: 10px">#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th style="width: 160px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$employee->first_name}}</td>
                                <td>{{$employee->last_name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->company_id}}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('employee.edit', $employee->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                    <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="confirmDeleteEmployee({{$employee->id}})"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            
                            
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{ $employees->links() }}
                        </ul>
                    </div>
                    </div>
                    <!-- /.card -->
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-delete-employee">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Delete employee</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure, Do you want to delete it?&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
                <form action="" method="POST" id="form-delete-employee">
                    @csrf
                <button type="submit" class="btn btn-outline-light">Confirm</button>
                </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script>
        //Confirmation for delete employee
        function confirmDeleteEmployee(employeeId){
            $("#form-delete-employee").attr('action', 'employee/destroy/' + employeeId);
            $('#modal-delete-employee').modal('show');
        }
    </script>
@endpush