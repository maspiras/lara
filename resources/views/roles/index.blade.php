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
                  <div class="table-responsive">                  
                  <table class="table table-bordered">
            <tr>
                <th width="100px">No</th>
                <th>Name</th>
                <th width="280px">Action</th>
            </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-list"></i> Show</a>
                        @can('role-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pen-to-square"></i> Edit</a>
                        @endcan

                        @can('role-delete')
                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>

            {!! $roles->links('pagination::bootstrap-5') !!}
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