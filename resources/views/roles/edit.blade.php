@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-5">
            <h1 class="m-0">Role Management</h1>
            <div class="pull-right">
                    @can('role-create')
                    <a class="btn btn-success btn-sm mb-2" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Create New Role</a>
                    @endcan
                </div>
          </div><!-- /.col -->
          
          
          <div class="col-sm-7">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
            @session('success')
            <div class="alert alert-success" role="alert"> 
                {{ $value }}
            </div>
        @endsession
              <div class="card">                
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Edit Role</h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary btn-sm mb-2" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                    </div>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif  
                    <div class="table-responsive">                  
                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Permission:</strong>
                                        <br/>
                                        @foreach($permission as $value)
                                            <label><input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="name" {{ in_array($value->id, $rolePermissions) ? 'checked' : ''}}>
                                            {{ $value->name }}</label>
                                        <br/>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->                
            </div><!-- /.Ccol -->     

        </div><!-- /.row -->        
      </div><!-- /.container-fluid -->      
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
@push('styles')  
  <style>

    
 
    div.container {
        width: 80%;
    }
  </style>
@endpush
@push('scripts')


<script type="text/javascript">
  $(function () {
    'use strict'
    /* $('.treeview-reports').addClass('active');        
    $('.menu-open-reports').addClass('menu-open');
    $('.reports-guest-payments').addClass('active'); */    
    
});
</script>
@endpush