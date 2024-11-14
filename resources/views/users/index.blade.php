@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-5">
            <h1 class="m-0">Employees</h1>
          </div><!-- /.col -->
          
          <div class="col-sm-3">
            @session('success')
                <div class="alert alert-success" role="alert"> 
                    {{ $value }}
                </div>
            @endsession            
          </div>  
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Employees</li>
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
            <div class="col-lg-12 margin-tb">                
                <div class="pull-right">
                    <a class="btn btn-success mb-2" href="{{ route('employees.create') }}"><i class="fa fa-plus"></i> Create New Employee</a>
                </div>
            </div>
        </div>
        <div class="row">        
            <div class="col-lg-12">
              <div class="card">
                
                <!-- /.card-header -->
                <div class="card-body">  
                  <div class="table-responsive">                  
                  <table class="table table-bordered">
   <tr>
       <th>No</th>
       <th>Name</th>
       <th>Email</th>
       <th>Roles</th>
       <th width="280px">Action</th>
   </tr>
   @foreach ($data as $key => $user)
        @php
          if($user->id == auth()->user()->host_id && auth()->user()->id != auth()->user()->host_id){
              break;
          }
        @endphp
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
               <label class="badge bg-success">{{ $v }}</label>
            @endforeach
          @endif
        </td>
        <td>
             
            <a class="btn btn-outline-primary btn-sm" href="{{ route('employees.edit',$user->id) }}"><i class="fa-solid fa fa-pen"></i> Edit</a>
             <a class="btn btn-sm btn-outline-success" href="{{ route('employees.show',$user->id) }}"><i class="fa fa-list"></i> Show</a>             
             <form method="POST" action="{{ route('employees.destroy', $user->id) }}" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
              </form>
            
              
        </td>
    </tr>
 @endforeach
</table>

{!! $data->links('pagination::bootstrap-5') !!}
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
 
@endpush
@push('scripts')

@endpush
